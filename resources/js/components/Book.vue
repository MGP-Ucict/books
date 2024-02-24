<template>
    <div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" id="title" :placeholder="Title" v-model="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" id="author" :placeholder="Author" v-model="author" class="form-control">
        </div>
        <div class="form-group">
            <label>Count pages</label>
            <input type="number" id="count-pages" :placeholder="Pages" v-model="countPages" class="form-control">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" id="price" :placeholder="Price" v-model="price" class="form-control" :min="0.00" :step="0.01">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea id="description" :placeholder="Description" v-model="description" class="form-control"></textarea>
        </div>
        <upload-file @uploadFile="setFile($event)" inputname="filename"
               placeholder="File"
               label="E-book" mutedtext=""></upload-file>
        <div class="alert alert-danger" v-for="error in errors" :key="error.id">
            <div v-for="e in error">
                {{e}}
            </div>
        </div>
        <div class="text-success my-4 text-center" v-show="success">
            Sucessfully saved data!
        </div>
        <div class="form-group w-100">
            <button type="submit" @click.prevent="handleSubmit"  :disabled="isDisabled"class="btn btn-primary d-block mx-auto">
               Save
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
            fileName: (typeof this.book !== "undefined") ? this.book.file_name : '',
            success: false,
            isDisabled: false,
            errors: [],
            };
        },
        methods: {
             setFile(file) {
                this.fileName = file;
            },
            save(url) {
                axios.post(url, formData, {
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
                                this.isDisabled = false;
                                this.errors = error.response.data.errors;
                            }
                    });
            },
            handleSubmit() {
                this.isDisabled = true;
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('author', this.author);
                formData.append('count_pages', this.countPages);
                formData.append('price', this.price);
                formData.append('description', this.description);
                if (this.fileName) {
                    formData.append('file_name', this.fileName);
                }
                this.success = false;
                if (!this.isEdit) {
                    this.save(`/api/book/`);
                } else {
                    formData.append('_method', 'PUT');
                    this.save(`/api/book/` + this.book.id);
                }
            }
        },
    }
</script>


