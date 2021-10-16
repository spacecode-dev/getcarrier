import axios from 'axios'

export default {
    actions: {
        GET_STEP: ({commit, getters}, data) => {
            return new Promise((resolve, reject) => {
                axios.post('/get-order-form-step', data)
                    .then((response) => {
                        resolve(response.data)
                    })
            })
        },
        SEND_FORM: ({}, data) => {
            return new Promise((resolve, reject) => {
                axios.post('/get-order-form', data)
                    .then((response) => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        reject(error.response.data)
                    })
            })
        },
        GET_CITY: ({}, data) => {
            return new Promise((resolve) => {
                axios.get('/get-city', {params: {name: data}}).then(function (response) {
                    resolve(response.data)
                })
            })
        },
        GET_LIMIT_CITY: ({}, data) => {
            return new Promise((resolve) => {
                axios.get('/get-city', {params: {name: data.name, limit: data.limit}}).then(function (response) {
                    resolve(response.data)
                })
            })
        },
        GET_MAKE: ({}, data) => {
            return new Promise((resolve) => {
                axios.get('/get-make', {params: data}).then(function (response) {
                    resolve(response.data)
                })
            })
        },
        GET_MODEL: ({}, data) => {
            return new Promise((resolve) => {
                axios.get('/get-model', {params: data}).then(function (response) {
                    resolve(response.data)
                })
            })
        },
        ACCEPT_COOKIE: ({}) => {
            return new Promise((resolve) => {
                axios.post('/put-cookie-data').then(function (response) {
                    resolve(response.data)
                })
            })
        },
    }
}
