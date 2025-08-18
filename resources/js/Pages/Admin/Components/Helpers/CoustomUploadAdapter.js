import axios from 'axios'

export default class CustomUploadAdapter {
    constructor(loader) {
        this.loader = loader
    }

    // Called by CKEditor to start upload
    upload() {
        return this.loader.file
            .then(file => {
                const formData = new FormData()
                formData.append('file', file)

                return axios.post('/editor/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                })
                    .then(response => {
                        // باید آدرس فایل ذخیره‌شده رو برگردونی
                        return {
                            default: response.data.url
                        }
                    })
            })
    }

    // Called if upload is aborted
    abort() {
        // می‌تونی اگر نیاز داشتی، ریکوئست axios رو cancel کنی
    }
}
