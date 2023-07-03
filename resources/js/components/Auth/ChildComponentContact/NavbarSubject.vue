<template>
    <ul>
        <li><a href="#footer" v-on:click="changeSubject('Permohonan Data dan Informasi')">Permohonan Data dan Informasi</a></li>
        <li><a href="#footer" v-on:click="changeSubject('Permohonan Narasumber')">Permohonan Narasumber</a></li>
        <li><a href="#footer" v-on:click="changeSubject('Permohonan Integrasi Data')">Permohonan Integrasi Data</a></li>
        <li><a href="#footer" v-on:click="changeSubject('Pelayanan Bimbingan')">Pelayanan Bimbingan</a>
            <ul class="dl-submenu">
                <li><a href="#footer">Praktik Kerja Lapangan</a></li>
                <li><a href="#footer">Bimbingan Skripsi/Tugas Akhir</a></li>
            </ul>
        </li>
        <li style=""><a href="">Pengaduan</a></li>
    </ul>
</template>

<script>
import { navbarSubject } from '../../../app.js';
export default ({
    methods: {
        changeSubject(subject) {
            navbarSubject.$emit('changeSubject', subject)
        }
    }
})
</script>
