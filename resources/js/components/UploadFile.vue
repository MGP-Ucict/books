<template>
    <div class="form-group">
        <label v-if="label" :for="inputname">{{ label }}</label>
        <span class="form-control file-upload-container"
              :class="{'border-danger': Boolean(errorText)}">
        <span class="placeholder-text" v-html="this.file ? this.file.name : placeholder">
            </span>
        <input @change="getFile($event)"
               type="file"
               :placeholder="placeholder" :name="inputname"
               :class="{'form-control': true, 'is-invalid': Boolean(errorText)}"
               :id="inputname">
        </span>
        <small v-if="mutedtext" class="form-text text-muted"><i>{{ mutedtext }}</i></small>
        <span class="text-danger" v-if="errorText">{{ errorText }}</span>
    </div>
</template>
<script>
export default {
    props: {
    placeholder: String, 
    label: String, 
    inputname: String, 
    mutedtext: String, 
    errorText: String
    },
    name: 'UploadFile',
    data() {
        return {
            file: null,
        };
    },
    methods: {
        getFile(event) {
            const file = event.target.files[0];
            if (file) {
                this.file = file;
                this.$emit('uploadFile', file);
            }
        },
    },
};
</script>