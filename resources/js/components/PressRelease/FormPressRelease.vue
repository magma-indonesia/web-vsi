<template>
    <a-form :form="form" @submit="handleSubmit" :layout="formLayout">
        <a-card>
            <a-row :gutter="[18, 18]">
                <a-col :xs="24" :sm="24" :md="24" :lg="8">
                    <div
                        class="flex justify-center items-center flex-column text-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="50px"
                            height="50px"
                            viewBox="0 0 24 24"
                            role="presentation"
                        >
                            <g transform="translate(4 2)">
                                <path
                                    d="M14.986,20a1.026,1.026,0,0,1-.515-.141L7.99,16.62,1.5,19.86a1.069,1.069,0,0,1-.491.13A1.016,1.016,0,0,1,0,18.97V3.79A3.316,3.316,0,0,1,1.437.875,6.154,6.154,0,0,1,4.9,0h6.17a6.181,6.181,0,0,1,3.47.875A3.362,3.362,0,0,1,16,3.79V18.97a1.022,1.022,0,0,1-.74.99A.933.933,0,0,1,14.986,20ZM4.22,6.04a.79.79,0,0,0,0,1.58h7.53a.79.79,0,0,0,0-1.58Z"
                                    transform="translate(0 0)"
                                    fill="var(--colors-reverse)"
                                ></path>
                            </g>
                        </svg>
                        <div
                            style="
                                font-size: 14px;
                                font-weight: bold;
                                margin-top: 10px;
                            "
                        >
                            Judul dan Kategori
                        </div>
                        <div style="font-size: 12px">
                            Gunakan judul yang jelas dan pilih kategori press
                            release yang sesuai.
                        </div>
                    </div>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="16">
                    <a-form-item label="Judul" :hasFeedback="true">
                        <a-input
                            placeholder="Judul dari press release"
                            v-decorator="[
                                'title',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Judul wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        label="Tanggal Press Release"
                        :hasFeedback="true"
                    >
                        <a-input
                            type="datetime-local"
                            v-decorator="[
                                'created_at',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Waktu wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                        />
                    </a-form-item>
                    <a-form-item label="No. Surat (optional)">
                        <a-input
                            placeholder="No. Surat Press Release jika ada"
                            v-decorator="['letter_number']"
                        />
                    </a-form-item>
                    <a-form-item label="Pilih Kategori">
                        <a-checkbox-group
                            v-decorator="[
                                'categories',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Kategori wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                            style="width: 100%"
                            @change="handleCategory"
                        >
                            <a-row :gutter="[3, 3]">
                                <a-col :span="24">
                                    <a-checkbox value="Gunung Api">
                                        Gunung Api
                                    </a-checkbox>
                                </a-col>
                                <a-col :span="24">
                                    <a-checkbox value="Gerakan Tanah">
                                        Gerakan Tanah
                                    </a-checkbox>
                                </a-col>
                                <a-col :span="24">
                                    <a-checkbox value="Gempa Bumi">
                                        Gempa Bumi
                                    </a-checkbox>
                                </a-col>
                                <a-col :span="24">
                                    <a-checkbox value="Tsunami">
                                        Tsunami
                                    </a-checkbox>
                                </a-col>
                                <a-col :span="24">
                                    <a-checkbox value="Lainnya">
                                        Lainnya
                                    </a-checkbox>
                                </a-col>
                            </a-row>
                        </a-checkbox-group>
                    </a-form-item>
                    <a-form-item
                        label="Kategori Lainnya"
                        v-if="showOther"
                        :hasFeedback="true"
                    >
                        <div
                            class="ant-form-extra"
                            style="
                                margin-top: 0px;
                                margin-bottom: 10px;
                                font-size: 12px;
                            "
                        >
                            Jika tidak ada pilihan kategori yang terdaftar,
                            silahkan masukkan kategori lainnya di sini
                        </div>
                        <a-input
                            placeholder="Kategori Lainnya"
                            v-decorator="[
                                'category',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Kategori wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        label="Pilih Gunung Api"
                        v-if="showMount"
                        :hasFeedback="true"
                    >
                        <a-select
                            show-search
                            option-filter-prop="children"
                            :filter-option="filterOption"
                            style="width: 100%"
                            v-decorator="[
                                'mountain_id',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Gunung Api wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                        >
                            <a-select-option
                                v-for="item in mountains"
                                :key="item"
                                :value="item.id"
                            >
                                {{ item.ga_nama_gapi }}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                    <a-form-item label="Pilih Label">
                        <div
                            class="ant-form-extra"
                            style="
                                margin-top: 0px;
                                margin-bottom: 10px;
                                font-size: 12px;
                            "
                        >
                            Label digunakan untuk melakukan grouping jenis
                            berita. Berguna untuk dilakukan filtering. Jika
                            label belum ada, bisa ditambahkan
                            <a
                                style="font-size: 12px"
                                href="javascript:;"
                                @click="openModalTag = true"
                                >disini</a
                            >
                        </div>
                        <a-checkbox-group
                            v-if="tags.length > 0"
                            v-decorator="[
                                'tags',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Label wajib diisi!',
                                        },
                                    ],
                                },
                            ]"
                            style="width: 100%"
                        >
                            <a-row :gutter="[3, 3]">
                                <a-col
                                    :span="24"
                                    v-for="(item, index) in tags"
                                    :key="index"
                                >
                                    <a-checkbox :value="item">
                                        {{ item }}
                                    </a-checkbox>
                                </a-col>
                            </a-row>
                        </a-checkbox-group>
                        <a-empty v-else>
                            <div style="font-size: 12px" slot="description">
                                <b>Oops data kosong</b> <br />
                                <span style="color: #8c8c8c">
                                    Data label tidak tersedia
                                </span>
                            </div>
                        </a-empty>
                    </a-form-item>
                </a-col>
            </a-row>
        </a-card>
        <a-card style="margin-top: 20px">
            <div class="flex items-center" style="gap: 30px">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="50px"
                    height="50px"
                    viewBox="0 0 24 24"
                    role="presentation"
                >
                    <g transform="translate(4 2)">
                        <path
                            d="M14.986,20a1.026,1.026,0,0,1-.515-.141L7.99,16.62,1.5,19.86a1.069,1.069,0,0,1-.491.13A1.016,1.016,0,0,1,0,18.97V3.79A3.316,3.316,0,0,1,1.437.875,6.154,6.154,0,0,1,4.9,0h6.17a6.181,6.181,0,0,1,3.47.875A3.362,3.362,0,0,1,16,3.79V18.97a1.022,1.022,0,0,1-.74.99A.933.933,0,0,1,14.986,20ZM4.22,6.04a.79.79,0,0,0,0,1.58h7.53a.79.79,0,0,0,0-1.58Z"
                            transform="translate(0 0)"
                            fill="var(--colors-reverse)"
                        ></path>
                    </g>
                </svg>
                <div class="flex flex-column">
                    <div style="font-size: 14px; font-weight: bold">
                        Dokumen dan Gambar Pendukung
                    </div>
                    <div style="font-size: 12px">
                        Upload dokumen dan gambar pendukung. File dokumen
                        maksimal yang bisa diupload adalah sebesar 5MB sementara
                        gambar, maksimal 3MB per gambar.
                    </div>
                </div>
            </div>
            <a-divider />
            <a-form-item label="Hapus Dokumen" v-if="retrieve">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Dokumen <b>exists</b> yang saat ini sedang digunakan dalam
                    press release. Pilih dokumen yang ingin dihapus.
                </div>

                <table-document
                    v-if="JSON.parse(retrieve).documents?.length > 0"
                    :documents="JSON.parse(retrieve).documents"
                    ref="tableDocuments"
                />
            </a-form-item>
            <a-form-item label="Dokumen">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Format dokumen yang diterima adalah format PDF dengan ukuran
                    per filenya <b>maksimal 5MB</b>.
                </div>
                <a-tabs
                    default-active-key="1"
                    @change="callback($event, 'document')"
                >
                    <a-tab-pane key="1" tab="Pilih Media">
                        <div
                            v-for="(item, index) in countDocumentMedia"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="select"
                                    @click="handleSelect(index, 'document')"
                                    >Pilih</a-button
                                >
                                <a-input
                                    :value="
                                        documentsMedia.length > 0
                                            ? documentsMedia[index]?.notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes(
                                            $event,
                                            index,
                                            'document'
                                        )
                                    "
                                    :disabled="
                                        documentsMedia.length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="
                                        handleAddUploadMedia(
                                            index + 1,
                                            'document'
                                        )
                                    "
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="
                                        handleRemoveUploadMedia(
                                            index,
                                            'document'
                                        )
                                    "
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="
                                    documentsMedia.length > 0 &&
                                    documentsMedia[index]
                                "
                            >
                                <div style="font-size: 12px">
                                    {{ documentsMedia[index]?.name }}
                                </div>
                                <a-button
                                    @click="
                                        handleDeleteFileMedia(
                                            documentsMedia[index]?.id,
                                            'document'
                                        )
                                    "
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                    <a-tab-pane key="2" tab="Upload Manual" force-render>
                        <div
                            v-for="(item, index) in countDocument"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="upload"
                                    @click="handleUpload(index, 'document')"
                                    >Browse</a-button
                                >
                                <a-input
                                    :value="
                                        documents.filter(
                                            (v) => v.index === index
                                        ).length > 0
                                            ? documents.filter(
                                                  (v) => v.index === index
                                              )[0].notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes(
                                            $event,
                                            index,
                                            'document'
                                        )
                                    "
                                    :disabled="
                                        documents.filter(
                                            (v) => v.index === index
                                        ).length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="
                                        handleAddUpload(index + 1, 'document')
                                    "
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="
                                        handleRemoveUpload(index, 'document')
                                    "
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="
                                    documents.length > 0 &&
                                    documents.filter((v) => v.index === index)
                                        .length > 0
                                "
                            >
                                <div style="font-size: 12px">
                                    {{
                                        documents.filter(
                                            (v) => v.index === index
                                        )[0].file.name
                                    }}
                                </div>
                                <a-button
                                    @click="handleDeleteFile(index, 'document')"
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                </a-tabs>
            </a-form-item>
            <a-divider />
            <a-form-item
                label="Hapus Peta KRB/Grafik/Hasil Pemodelan"
                v-if="retrieve"
            >
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Peta KRB/Grafik/Hasil Pemodelan <b>exists</b> yang saat ini
                    sedang digunakan dalam press release. Pilih yang ingin
                    dihapus.
                </div>

                <table-maps
                    v-if="JSON.parse(retrieve).maps?.length > 0"
                    :maps="JSON.parse(retrieve).maps"
                    ref="tableMaps"
                />
            </a-form-item>
            <a-form-item label="Peta KRB/Grafik/Hasil Pemodelan">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Gunakan menu ini untuk mengupload file hasil olahan data
                    pemantauan. Format yang diterima adalah format gambar. Per
                    file <b>maksimal 3MB</b>.
                </div>
                <a-tabs
                    default-active-key="1"
                    @change="callback($event, 'peta')"
                >
                    <a-tab-pane key="1" tab="Pilih Media">
                        <div
                            v-for="(item, index) in countPetaMedia"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="select"
                                    @click="handleSelect(index, 'peta')"
                                    >Pilih</a-button
                                >
                                <a-input
                                    :value="
                                        mapsMedia.length > 0
                                            ? mapsMedia[index]?.notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes(
                                            $event,
                                            index,
                                            'thumbnail'
                                        )
                                    "
                                    :disabled="
                                        mapsMedia.length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="
                                        handleAddUploadMedia(index + 1, 'peta')
                                    "
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="
                                        handleRemoveUploadMedia(index, 'peta')
                                    "
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="mapsMedia.length > 0 && mapsMedia[index]"
                            >
                                <div style="font-size: 12px">
                                    {{ mapsMedia[index]?.name }}
                                </div>
                                <a-button
                                    @click="
                                        handleDeleteFileMedia(
                                            mapsMedia[index]?.id,
                                            'peta'
                                        )
                                    "
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                    <a-tab-pane key="2" tab="Upload Manual" force-render>
                        <div
                            v-for="(item, index) in countPeta"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="upload"
                                    @click="handleUpload(index, 'peta')"
                                    >Browse</a-button
                                >
                                <a-input
                                    :value="
                                        maps.filter((v) => v.index === index)
                                            .length > 0
                                            ? maps.filter(
                                                  (v) => v.index === index
                                              )[0].notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes($event, index, 'peta')
                                    "
                                    :disabled="
                                        maps.filter((v) => v.index === index)
                                            .length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="handleAddUpload(index + 1, 'peta')"
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="handleRemoveUpload(index, 'peta')"
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="
                                    maps.length > 0 &&
                                    maps.filter((v) => v.index === index)
                                        .length > 0
                                "
                            >
                                <div style="font-size: 12px">
                                    {{
                                        maps.filter((v) => v.index === index)[0]
                                            .file.name
                                    }}
                                </div>
                                <a-button
                                    @click="handleDeleteFile(index, 'peta')"
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                </a-tabs>
            </a-form-item>
            <a-divider />
            <a-form-item label="Hapus Foto/Gambar" v-if="retrieve">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Foto/Gambar <b>exists</b> yang saat ini sedang digunakan
                    dalam press release. Pilih yang ingin dihapus.
                </div>

                <table-thumbnail
                    v-if="JSON.parse(retrieve).thumbnails?.length > 0"
                    :thumbnails="JSON.parse(retrieve).thumbnails"
                    ref="tableThumbnails"
                />
            </a-form-item>
            <a-form-item label="Foto/Gambar">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Bisa dalam bentuk Infografis, Poster, Leaflet, Flyer atau
                    Publikasi lainnya. Format yang diterima adalah format
                    gambar. Per file <b>maksimal 3MB</b>.
                </div>
                <a-tabs
                    default-active-key="1"
                    @change="callback($event, 'thumbnail')"
                >
                    <a-tab-pane key="1" tab="Pilih Media">
                        <div
                            v-for="(item, index) in countThumbnailMedia"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="select"
                                    @click="handleSelect(index, 'thumbnail')"
                                    >Pilih</a-button
                                >
                                <a-input
                                    :value="
                                        thumbnailsMedia.length > 0
                                            ? thumbnailsMedia[index]?.notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes(
                                            $event,
                                            index,
                                            'thumbnail'
                                        )
                                    "
                                    :disabled="
                                        thumbnailsMedia.length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="
                                        handleAddUploadMedia(
                                            index + 1,
                                            'thumbnail'
                                        )
                                    "
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="
                                        handleRemoveUploadMedia(
                                            index,
                                            'thumbnail'
                                        )
                                    "
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="
                                    thumbnailsMedia.length > 0 &&
                                    thumbnailsMedia[index]
                                "
                            >
                                <div style="font-size: 12px">
                                    {{ thumbnailsMedia[index]?.name }}
                                </div>
                                <a-button
                                    @click="
                                        handleDeleteFileMedia(
                                            thumbnailsMedia[index]?.id,
                                            'thumbnail'
                                        )
                                    "
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                    <a-tab-pane key="2" tab="Upload Manual" force-render>
                        <div
                            v-for="(item, index) in countThumbnail"
                            :key="index"
                            style="margin-bottom: 10px"
                        >
                            <div class="flex items-center">
                                <a-button
                                    type="primary"
                                    icon="upload"
                                    @click="handleUpload(index, 'thumbnail')"
                                    >Browse</a-button
                                >
                                <a-input
                                    :value="
                                        thumbnails.filter(
                                            (v) => v.index === index
                                        ).length > 0
                                            ? thumbnails.filter(
                                                  (v) => v.index === index
                                              )[0].notes
                                            : ''
                                    "
                                    @change="
                                        handleChangeNotes(
                                            $event,
                                            index,
                                            'thumbnail'
                                        )
                                    "
                                    :disabled="
                                        thumbnails.filter(
                                            (v) => v.index === index
                                        ).length === 0
                                    "
                                    placeholder="(Optional) Keterangan file"
                                ></a-input>
                                <a-button
                                    type="primary"
                                    icon="plus"
                                    v-if="index === 0"
                                    @click="
                                        handleAddUpload(index + 1, 'thumbnail')
                                    "
                                ></a-button>
                                <a-button
                                    type="danger"
                                    icon="minus"
                                    @click="
                                        handleRemoveUpload(index, 'thumbnail')
                                    "
                                    v-else
                                ></a-button>
                            </div>
                            <div
                                class="flex items-center gap-10"
                                style="margin-top: 10px"
                                v-if="
                                    thumbnails.length > 0 &&
                                    thumbnails.filter((v) => v.index === index)
                                        .length > 0
                                "
                            >
                                <div style="font-size: 12px">
                                    {{
                                        thumbnails.filter(
                                            (v) => v.index === index
                                        )[0].file.name
                                    }}
                                </div>
                                <a-button
                                    @click="
                                        handleDeleteFile(index, 'thumbnail')
                                    "
                                    type="danger"
                                    size="small"
                                    icon="delete"
                                ></a-button>
                            </div>
                        </div>
                    </a-tab-pane>
                </a-tabs>
            </a-form-item>
        </a-card>
        <a-card style="margin-top: 20px">
            <a-form-item label="Konten dari Press Release">
                <div
                    class="ant-form-extra"
                    style="
                        margin-top: 0px;
                        margin-bottom: 10px;
                        font-size: 12px;
                    "
                >
                    Gunakan judul yang jelas, tuliskan deskripsi dengan
                    menggunakan bahasa Indonesia yang baku dan sesuai dengan
                    EYD.
                </div>
                <tiny-mce
                    @change="handleChangeTiny($event)"
                    :value.sync="desc"
                    :apiurl="apiurl"
                    :type="'press-release'"
                ></tiny-mce>
            </a-form-item>
        </a-card>
        <a-card style="margin-top: 20px">
            <a-row :gutter="[18, 18]">
                <a-col :xs="24" :sm="24" :md="24" :lg="8">
                    <div
                        class="flex justify-center items-center flex-column text-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="50px"
                            height="50px"
                            viewBox="0 0 24 24"
                            role="presentation"
                        >
                            <g transform="translate(4 2)">
                                <path
                                    d="M14.986,20a1.026,1.026,0,0,1-.515-.141L7.99,16.62,1.5,19.86a1.069,1.069,0,0,1-.491.13A1.016,1.016,0,0,1,0,18.97V3.79A3.316,3.316,0,0,1,1.437.875,6.154,6.154,0,0,1,4.9,0h6.17a6.181,6.181,0,0,1,3.47.875A3.362,3.362,0,0,1,16,3.79V18.97a1.022,1.022,0,0,1-.74.99A.933.933,0,0,1,14.986,20ZM4.22,6.04a.79.79,0,0,0,0,1.58h7.53a.79.79,0,0,0,0-1.58Z"
                                    transform="translate(0 0)"
                                    fill="var(--colors-reverse)"
                                ></path>
                            </g>
                        </svg>
                        <div
                            style="
                                font-size: 14px;
                                font-weight: bold;
                                margin-top: 10px;
                            "
                        >
                            Simpan dan Publikasi
                        </div>
                        <div style="font-size: 12px">
                            Simpan dan atau publikasi press release yang dibuat.
                        </div>
                    </div>
                </a-col>
                <a-col :xs="24" :sm="24" :md="24" :lg="16">
                    <a-form-item
                        label="Apakah Press Release akan dipublikasikan langsung?"
                    >
                        <a-radio-group v-decorator="['status']">
                            <a-radio value="1">Ya, segera publikasikan</a-radio>
                            <a-radio value="0"
                                >Tidak, simpan sebagai draft</a-radio
                            >
                        </a-radio-group>
                    </a-form-item>
                    <a-divider />
                    <a-button
                        style="margin-top: 10px"
                        type="danger"
                        ghost
                        @click="handleClose"
                    >
                        Tutup
                    </a-button>
                    <a-button
                        type="primary"
                        html-type="submit"
                        :disabled="loading"
                    >
                        <span v-if="!loading"> Simpan </span>
                        <span v-else> Mohon tunggu... </span>
                    </a-button>
                </a-col>
            </a-row>
        </a-card>

        <a-modal v-model="openModalTag" title="Tambah tag" :footer="false">
            <form-tag
                @close="handleCloseModalTag"
                :apiurl="apiurl"
                :pressrelease="true"
            />
        </a-modal>
        <a-modal
            @cancel="handleCloseModalFile(null)"
            v-model="openModalFile"
            title="Pilih file"
            :footer="false"
            width="90%"
        >
            <card-files
                @close="handleCloseModalFile"
                :index.sync="modalIndex"
                :type.sync="modalType"
                :apiurl="apiurl"
                :role="role"
            />
        </a-modal>
    </a-form>
</template>

<script>
import axios from "axios";
import helper from "../../utils/helper";
import TinyMce from "../Utils/TinyMce.vue";
import FormTag from "../UploadCenter/FormTag.vue";
import TableDocument from "./TableDocument.vue";
import TableMaps from "./TableMaps.vue";
import TableThumbnail from "./TableThumbnail.vue";
import CardFiles from "./CardFiles.vue";

export default {
    components: {
        TinyMce,
        FormTag,
        TableDocument,
        TableMaps,
        TableThumbnail,
        CardFiles,
    },
    props: ["apiurl", "backurl", "retrieve", "category", "role"],
    data() {
        return {
            formLayout: "vertical",
            form: null,
            loading: false,
            desc: null,
            openModalTag: false,
            openModalFile: false,
            modalIndex: "",
            modalType: "",
            files: [],
            showMount: false,
            showOther: false,
            mountains: [],
            tags: [],
            countDocument: [1],
            countDocumentMedia: [1],
            countPeta: [1],
            countPetaMedia: [1],
            countThumbnail: [1],
            countThumbnailMedia: [1],
            documents: [],
            documentsMedia: [],
            maps: [],
            mapsMedia: [],
            thumbnails: [],
            thumbnailsMedia: [],
            isManualDocument: 1,
            isManualMaps: 1,
            isManualThumbnails: 1,
        };
    },
    async created() {
        await this.fetchMountain();
        let retrieve = null;
        if (this.retrieve) {
            retrieve = await JSON.parse(this.retrieve);
        }

        this.desc = retrieve?.content;
        let addCat = [];
        if (retrieve?.categories?.length > 0) {
            retrieve?.categories?.map(async (v) => {
                if (v.category === "Gunung Api") {
                    this.showMount = true;
                }

                if (v.category?.indexOf("Lainnya") > -1) {
                    addCat.push({
                        id: v.id,
                        press_release_id: v.press_release_id,
                        category: "Lainnya",
                        created_at: v.created_at,
                        updated_at: v.updated_at,
                    });
                    this.showOther = true;
                }
            });
        }

        if (addCat.length > 0) {
            retrieve?.categories?.push(addCat[0]);
        }

        this.form = this.$form.createForm(this, {
            name: "form-news",

            mapPropsToFields: () => {
                return {
                    title: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.title,
                    }),
                    letter_number: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.letter_number,
                    }),
                    created_at: this.$form.createFormField({
                        ...retrieve,
                        value: helper.formattedTime(
                            new Date(retrieve?.created_at)
                        ),
                    }),
                    categories: this.$form.createFormField({
                        ...retrieve,
                        value:
                            retrieve?.categories?.length > 0
                                ? retrieve?.categories?.map((v) => v.category)
                                : [],
                    }),
                    category: this.$form.createFormField({
                        ...retrieve,
                        value:
                            retrieve?.categories?.length > 0
                                ? retrieve?.categories?.filter(
                                      (v) => v.category.indexOf("Lainnya") > -1
                                  )?.length > 0
                                    ? retrieve?.categories?.filter(
                                          (v) =>
                                              v.category.indexOf("Lainnya") > -1
                                      )[0]?.category
                                    : ""
                                : "",
                    }),
                    mountain_id: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.mountain ? retrieve?.mountain?.id : "",
                    }),
                    tags: this.$form.createFormField({
                        ...retrieve,
                        value:
                            retrieve?.tags?.length > 0
                                ? retrieve?.tags?.map((v) => v.name)
                                : [],
                    }),
                    status: this.$form.createFormField({
                        ...retrieve,
                        value: retrieve?.status?.toString(),
                    }),
                };
            },
        });
    },
    mounted() {
        this.fetchTags();
    },
    methods: {
        filterOption(input, option) {
            return (
                option.componentOptions.children[0].text
                    .toLowerCase()
                    .indexOf(input.toLowerCase()) >= 0
            );
        },
        callback(key, type) {
            if (type === "document") {
                this.isManualDocument = key;
            }

            if (type === "peta") {
                this.isManualMaps = key;
            }

            if (type === "thumbnail") {
                this.isManualThumbnails = key;
            }
        },
        fetchMountain() {
            axios.get(`${this.apiurl}/api/mountain`).then((res) => {
                if (res) {
                    this.mountains = res.data.serve;
                }
            });
        },
        fetchTags() {
            axios
                .get(
                    `${this.apiurl}/dashboard/api/upload-center/tags?is_press_release=1`
                )
                .then(async (data) => {
                    this.tags = data?.data?.serve;
                });
        },
        async handleCategory(e) {
            if (e.includes("Gunung Api")) {
                await this.fetchMountain();
                this.showMount = true;
            } else {
                this.showMount = false;
            }

            if (e.includes("Lainnya")) {
                this.showOther = true;
            } else {
                this.showOther = false;
            }
        },
        handleChangeTiny(e) {
            this.desc = e;
        },
        handleCloseModalTag() {
            this.openModalTag = false;
            this.fetchTags();
        },
        handleCloseModalFile(e) {
            if (this.modalType === "document" && e) {
                this.documentsMedia.push(e);
            }
            if (this.modalType === "peta" && e) {
                this.mapsMedia.push(e);
            }
            if (this.modalType === "thumbnail" && e) {
                this.thumbnailsMedia.push(e);
            }
            this.modalIndex = "";
            this.modalType = "";
            this.openModalFile = false;
        },
        handleClose() {
            window.location.href = this.backurl;
        },
        handleAddUpload(index, type) {
            if (type === "document") {
                const dirtyCountDoc = this.countDocument;
                dirtyCountDoc.push(index);
                this.countDocument = dirtyCountDoc;
            }

            if (type === "peta") {
                const dirtyCountPeta = this.countPeta;
                dirtyCountPeta.push(index);
                this.countPeta = dirtyCountPeta;
            }

            if (type === "thumbnail") {
                const dirtyCountThumbnail = this.countThumbnail;
                dirtyCountThumbnail.push(index);
                this.countThumbnail = dirtyCountThumbnail;
            }
        },
        handleAddUploadMedia(index, type) {
            if (type === "document") {
                const dirtyCountDoc = this.countDocumentMedia;
                dirtyCountDoc.push(index);
                this.countDocumentMedia = dirtyCountDoc;
            }

            if (type === "peta") {
                const dirtyCountPeta = this.countPetaMedia;
                dirtyCountPeta.push(index);
                this.countPetaMedia = dirtyCountPeta;
            }

            if (type === "thumbnail") {
                const dirtyCountThumbnail = this.countThumbnailMedia;
                dirtyCountThumbnail.push(index);
                this.countThumbnailMedia = dirtyCountThumbnail;
            }
        },
        handleRemoveUpload(index, type) {
            if (type === "document") {
                const dirtyCountDoc = this.countDocument;
                dirtyCountDoc.splice(index, 1);
                this.countDocument = dirtyCountDoc;
                this.handleDeleteFile(index, type);
            }

            if (type === "peta") {
                const dirtyCountPeta = this.countPeta;
                dirtyCountPeta.splice(index, 1);
                this.countPeta = dirtyCountPeta;
                this.handleDeleteFile(index, type);
            }

            if (type === "thumbnail") {
                const dirtyCountThumbnail = this.countThumbnail;
                dirtyCountThumbnail.splice(index, 1);
                this.countThumbnail = dirtyCountThumbnail;
                this.handleDeleteFile(index, type);
            }
        },
        handleRemoveUploadMedia(index, type) {
            if (type === "document") {
                const dirtyCountDoc = this.countDocumentMedia;
                dirtyCountDoc.splice(index, 1);
                this.countDocumentMedia = dirtyCountDoc;
                this.handleDeleteFileMedia(index, type);
            }

            if (type === "peta") {
                const dirtyCountPeta = this.countPetaMedia;
                dirtyCountPeta.splice(index, 1);
                this.countPetaMedia = dirtyCountPeta;
                this.handleDeleteFileMedia(index, type);
            }

            if (type === "thumbnail") {
                const dirtyCountThumbnail = this.countThumbnailMedia;
                dirtyCountThumbnail.splice(index, 1);
                this.countThumbnailMedia = dirtyCountThumbnail;
                this.handleDeleteFileMedia(index, type);
            }
        },
        handleUpload(index, type) {
            const input = document.createElement("input");
            input.type = "file";
            input.accept = type === "document" ? "application/pdf" : "image/*";
            input.onchange = (e) => {
                const file = e.target.files[0];
                const sizeFile = 5000000;
                if (file.size < sizeFile) {
                    if (type === "document") {
                        this.documents.push({
                            file,
                            index,
                            notes: "",
                        });
                    }
                    if (type === "peta") {
                        this.maps.push({
                            file,
                            index,
                            notes: "",
                        });
                    }
                    if (type === "thumbnail") {
                        this.thumbnails.push({
                            file,
                            index,
                            notes: "",
                        });
                    }
                } else {
                    this.$notification.error({
                        message: "Size dokumen maksimal adalah 5mb.",
                        placement: "bottomRight",
                        duration: 5,
                    });
                }
            };
            input.click();
        },
        handleDeleteFile(i, type) {
            if (type === "document") {
                const dirtyDoc = this.documents.filter((v) => v.index !== i);
                this.documents = dirtyDoc;
            }
            if (type === "peta") {
                const dirtyPeta = this.maps.filter((v) => v.index !== i);
                this.maps = dirtyPeta;
            }

            if (type === "thumbnail") {
                const dirtyThumbnail = this.thumbnails.filter(
                    (v) => v.index !== i
                );
                this.thumbnails = dirtyThumbnail;
            }
        },
        handleDeleteFileMedia(i, type) {
            if (type === "document") {
                const dirtyDoc = this.documentsMedia.filter((v) => v.id !== i);
                this.documentsMedia = dirtyDoc;
            }
            if (type === "peta") {
                const dirtyPeta = this.mapsMedia.filter((v) => v.id !== i);
                this.mapsMedia = dirtyPeta;
            }

            if (type === "thumbnail") {
                const dirtyThumbnail = this.thumbnailsMedia.filter(
                    (v) => v.id !== i
                );
                this.thumbnailsMedia = dirtyThumbnail;
            }
        },
        handleChangeNotes(e, i, type) {
            if (type === "document") {
                const dirtyDoc = this.documents.filter((v) => v.index === i);
                dirtyDoc[0].notes = e.target.value;
            }

            if (type === "peta") {
                const dirtyPeta = this.maps.filter((v) => v.index === i);
                dirtyPeta[0].notes = e.target.value;
            }

            if (type === "thumbnail") {
                const dirtyThumbnail = this.thumbnails.filter(
                    (v) => v.index === i
                );
                dirtyThumbnail[0].notes = e.target.value;
            }
        },
        handleSubmit(e) {
            e.preventDefault();
            this.loading = true;
            this.form.validateFields(async (err, values) => {
                if (!err) {
                    const fd = new FormData();
                    fd.append("title", values.title);
                    fd.append("created_at", values.created_at);
                    fd.append("letter_number", values.letter_number ?? "");

                    if (values.category) {
                        if (values.categories.length > 0) {
                            const findIdxLainnya = values.categories.findIndex(
                                (v) => v === "Lainnya"
                            );
                            if (findIdxLainnya > -1) {
                                values.categories[findIdxLainnya] =
                                    "Lainnya (" + values.category + ")";
                            }
                            values.categories = values.categories;
                        } else {
                            values.categories = [values.category];
                        }
                        fd.append("categories", values.categories);
                    } else {
                        fd.append("categories", values.categories);
                    }
                    fd.append("mountain_id", values.mountain_id ?? "");
                    fd.append("tags", values.tags);
                    fd.append("count_document", this.documents.length);
                    if (this.documents.length > 0) {
                        this.documents.map((v, i) => {
                            fd.append("document-" + i, v.file);
                            fd.append("document-notes-" + i, v.notes);
                        });
                    }
                    fd.append(
                        "count_document_media",
                        this.documentsMedia.length
                    );
                    if (this.documentsMedia.length > 0) {
                        this.documentsMedia.map((v, i) => {
                            fd.append("document-media-" + i, v.id);
                        });
                    }
                    fd.append("count_map", this.maps.length);
                    if (this.maps.length > 0) {
                        this.maps.map((v, i) => {
                            fd.append("map-" + i, v.file);
                            fd.append("map-notes-" + i, v.notes);
                        });
                    }
                    fd.append("count_map_media", this.mapsMedia.length);
                    if (this.mapsMedia.length > 0) {
                        this.mapsMedia.map((v, i) => {
                            fd.append("map-media-" + i, v.id);
                        });
                    }
                    fd.append("count_thumbnail", this.thumbnails.length);
                    if (this.thumbnails.length > 0) {
                        this.thumbnails.map((v, i) => {
                            fd.append("thumbnail-" + i, v.file);
                            fd.append("thumbnail-notes-" + i, v.notes);
                        });
                    }
                    fd.append(
                        "count_thumbnail_media",
                        this.thumbnailsMedia.length
                    );
                    if (this.thumbnailsMedia.length > 0) {
                        this.thumbnailsMedia.map((v, i) => {
                            fd.append("thumbnail-media-" + i, v.id);
                        });
                    }
                    fd.append("is_manual_document", this.isManualDocument);
                    fd.append("is_manual_map", this.isManualMaps);
                    fd.append("is_manual_thumbnail", this.isManualThumbnails);
                    fd.append("desc", this.desc ?? "");
                    fd.append("status", values.status ?? 0);

                    fd.append("maps_media", this.documentsMedia);

                    if (this.retrieve) {
                        let retrieve = await JSON.parse(this.retrieve);
                        fd.append("id", retrieve?.id);

                        if (this.$refs["tableDocuments"]) {
                            fd.append(
                                "documents_old_data",
                                JSON.stringify(
                                    this.$refs["tableDocuments"]?.data
                                )
                            );
                        }

                        if (this.$refs["tableMaps"]) {
                            fd.append(
                                "maps_old_data",
                                JSON.stringify(this.$refs["tableMaps"]?.data)
                            );
                        }

                        if (this.$refs["tableThumbnails"]) {
                            fd.append(
                                "thumbnails_old_data",
                                JSON.stringify(
                                    this.$refs["tableThumbnails"]?.data
                                )
                            );
                        }
                        fd.append("_method", "PUT");
                        axios
                            .post(
                                `${this.apiurl}/dashboard/press-release/apis`,
                                fd
                            )
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.handleClose();
                            })
                            .catch((err) => {
                                this.loading = false;
                            });
                    } else {
                        axios
                            .post(
                                `${this.apiurl}/dashboard/press-release/apis`,
                                fd
                            )
                            .then(() => {
                                this.form.resetFields();
                                this.loading = false;
                                this.handleClose();
                            })
                            .catch(() => {
                                this.loading = false;
                            });
                    }
                } else {
                    this.loading = false;
                }
            });
        },
        handleSelect(index, type) {
            this.modalIndex = index;
            this.modalType = type;
            this.openModalFile = true;
        },
    },
};
</script>
