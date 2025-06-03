<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'paketwisata_id',
        'pemesan_id',
        'pemesanan_id',
        'jenis_transaksi',
        'deposit',
        'balance',
        'jumlah_peserta',
        'owe_to_me',
        'pay_to_provider',
        'additional_charge',
        'total_transaksi',
        'transaksi_status',
    ];

    /**
     * Relasi ke PaketWisata
     */
    public function paketWisata()
    {
        return $this->belongsTo(
            PaketWisata::class,
            'paketwisata_id',
            'paketwisata_id'
        );
    }

    /**
     * Relasi ke Pelanggan (pemesan)
     */
    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'pemesan_id',
            'pelanggan_id'
        );
    }

    /**
     * Relasi ke Pemesanan
     */
    public function pemesanan()
    {
        return $this->belongsTo(
            Pemesanan::class,
            'pemesanan_id',
            'pemesanan_id'
        );
    }

    /**
     * Detail transaksi (jika ada satu detail per transaksi)
     */
    public function detailTransaksi()
    {
        return $this->hasOne(
            DetailTransaksi::class,
            'transaksi_id',
            'transaksi_id'
        );
    }

    /**
 * Ketersediaan yang dibuat saat status 'paid'
 */
public function ketersediaan()
{
    return $this->hasOne(
        \App\Models\Ketersediaan::class,
        'pemesanan_id',   // FK di tabel ketersediaans
        'pemesanan_id'    // PK di tabel transaksis
    );
}


public function includeModel()
{
    return $this->hasOne(
        \App\Models\IncludeModel::class,
        'pemesanan_id',  // foreign key di includes
        'pemesanan_id'   // local key di transaksis
    );
}

public function exclude()
{
    return $this->hasOne(
        \App\Models\Exclude::class,
        'pemesanan_id',  // foreign key di excludes
        'pemesanan_id'   // local key di transaksis
    );
}

}
