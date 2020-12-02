<template>
    <div v-if="email !== null" class="form-group col-md-6">
        <br />
        <h4>Email details</h4>
        Email from: <b>{{email.emailFrom}}</b>
        <br />
        Email to: <b>{{email.emailTo}}</b>
        <br />
        Email subject is: <b>{{email.subject}}</b>
        <br />
        Email status: <b>{{email.status}}</b>
    </div>
</template>

<script>
import axios from "axios"
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

export default {
    name: 'singleEmail',
    data() {
        return {
            email: null
        }
    },
    created() {
    axios.get(`http://mailersend.test/singlemail/` + this.$route.params.mailId)
    .then(response => {
        this.email = response.data
    })
    .catch(e => {
        this.errors.push(e)
    })
  },
};
</script>