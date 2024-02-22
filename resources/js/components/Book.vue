<template>
    <div>
        <div class="form-group">
            <label>{{ $t('Title')}}</label>
            <input type="text" id="title" :placeholder="$t('Title')" v-model="title" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ $t('Author')}}</label>
            <input type="text" id="author" :placeholder="$t('Author')" v-model="author" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ $t('Count pages')}}</label>
            <input type="number" id="count-pages" :placeholder="$t('Count pages')" v-model="countPages" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ $t('Price')}}</label>
            <input type="number" id="price" :placeholder="$t('Price')" v-model="price" class="form-control" :min="0.00" :step="0.01">
        </div>
        <div class="form-group">
            <label>{{ $t('Description')}}</label>
            <textarea id="description" :placeholder="$t('Description')" v-model="description"></textarea>
        </div>
        <upload-file @uploadFile="setFilename($event)" inputname="filename"
               :placeholder="$t('File upload') + '<i class=\'las la-upload\'></i>'"
               :label="$t('Upload E-book')" mutedtext=""></upload-file>
        <div class="alert alert-danger" v-for="error in errors" :key="error.id">
            <div v-for="e in error">
                {{$t(e)}}
            </div>
        </div>
        <div class="text-success my-4 text-center">
            {{ successMessage }}
        </div>
        <div class="form-group w-100">
            <button type="submit" @click.prevent="handleSubmit" class="btn btn-primary d-block mx-auto">
               {{ $t('Save')}}
            </button>
        </div>
    </div>
</template>
<script>
 export default {
    name: "Book",
    props: {
        book: Object,
        isEdit: Boolean
    },
    data() {
        return {
            title: (typeof this.book !== "undefined") ? this.book.title : '',
            author: (typeof this.book !== "undefined") ? this.book.author : '',
            countPages: (typeof this.book !== "undefined") ? this.book.count_pages : 0,
            price: (typeof this.book !== "undefined") ? this.book.price : 0,
            description: (typeof this.book !== "undefined") ? this.book.description : '',
            seccessMessage: '',
            success: false,
            isDisabled: false,
            errors: [],
        },
        methods: {
            handleSubmit() {
                this.isDisabled = true;
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('author', this.author);
                formData.append('count_pages', this.countPages);
                formData.append('price', this.price);
                formData.append('description', this.description);
                this.success = false;
                if (!this.isEdit) {
                    axios.post(`/api/book/`, formData,  {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                            if (response.status === 200 || response.status === 201) {
                                this.success = true;
                                window.location.href = '/books/';
                            } else {
                                this.isDisabled = false;
                                if (response.errors) {
                                    this.errors = response.errors;
                                }
                            }
                        }).catch((error) => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                        });
                } else {
                    formData.append('_method', 'PUT');
                    axios.post(`/api/book/` + this.book.id, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                            if (response.status === 200 || response.status === 201) {
                                this.success = true;
                                window.location.href = '/books';
                            } else {
                                this.isDisabled = false;
                                if (response.errors) {
                                    this.errors = response.errors;
                                }
                            }
                        }).catch((error) => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                    });
                }
            }
        },
    }
</script>


