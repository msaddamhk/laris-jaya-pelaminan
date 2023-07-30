<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'no_pemesanan',
        'tanggal_acara',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesananItem()
    {
        return $this->hasMany(PemesananItem::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function jumlahhari()
    {
        return $this->booking()->count();
    }

    public function jumlah()
    {
        return $this->pemesananItem->reduce(function ($total, $item) {
            return $total += (($item->jasa->harga + $item->pemesananItemOpsi->reduce(function ($total, $item) {
                return $total += $item->jasaOpsiItem->harga;
            })) * $item->jumlah);
        }) * $this->jumlahhari();
    }


    public function hitungKeuntungan()
    {
        $totalKeuntungan = 0;

        foreach ($this->pemesananItem as $pesananItem) {
            $jasa = $pesananItem->jasa;
            $keuntunganJasa = ($jasa->harga - $jasa->modal);

            $totalPesananItemOpsi = 0;

            foreach ($pesananItem->pemesananItemOpsi as $pesananItemOpsi) {
                $jasaOpsiItem = $pesananItemOpsi->jasaOpsiItem;
                $totalPesananItemOpsi += $jasaOpsiItem->harga - $jasaOpsiItem->modal;
            }

            $keuntunganJasaOpsi = $totalPesananItemOpsi;
            $totalKeuntungan += ($keuntunganJasa + $keuntunganJasaOpsi) * $pesananItem->jumlah;
        }

        return $totalKeuntungan * $this->jumlahhari();
    }

    public function hitungPemasukan()
    {
        $totalPemasukan = 0;

        foreach ($this->pemesananItem as $pesananItem) {
            $jasa = $pesananItem->jasa;
            $pemasukanJasa = $jasa->harga;

            $totalPesananItemOpsi = 0;

            foreach ($pesananItem->pemesananItemOpsi as $pesananItemOpsi) {
                $jasaOpsiItem = $pesananItemOpsi->jasaOpsiItem;
                $totalPesananItemOpsi += $jasaOpsiItem->harga;
            }

            $pemasukanJasaOpsi = $totalPesananItemOpsi;

            $totalPemasukan += ($pemasukanJasa + $pemasukanJasaOpsi) * $pesananItem->jumlah;
        }

        return $totalPemasukan * $this->jumlahhari();
    }
}
