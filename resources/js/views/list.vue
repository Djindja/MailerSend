<template>
    <div class="form-group col-md-12">
    <br/>
    <div class="title">
      <h4>List of all emails</h4>
    </div>

    <div class="search">
      <input v-model="search" class="form-control col-md-4" type="text" placeholder="Search...">
    </div>
    <br/>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" v-model="status" id="posted" name="status" value="posted">
      <label class="form-check-label" for="posed"> Posted</label><br>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" v-model="status" id="sent" name="status" value="sent">
      <label class="form-check-label" for="sent"> Sent</label><br>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" v-model="status" id="failed" name="status" value="failed">
      <label class="form-check-label" for="failed"> Failed</label><br>
    </div>
    <br/>
    <br/>
    <div class="content">
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: left; width: 20%;">Link to Single Email from User</th>
            <th style="text-align: left; width: 20%;">Email From</th>
            <th style="text-align: left; width: 20%;">Email To</th>
            <th style="text-align: left; width: 20%;">Subject</th>
            <th style="text-align: left; width: 20%;">Status</th>
          </tr>
        </thead>
        <tbody>
        <tr v-for="email in filteredList" :key="email.id">
          <td style="text-align: left; width: 20%;"><router-link :to="{ name: 'single', params: { mailId: email.id }}">Go to Single Email</router-link></td>
          <td style="text-align: left; width: 20%;">{{ email.emailFrom }}</td>
          <td style="text-align: left; width: 20%;">{{email.emailTo}}</td>
          <td style="text-align: left; width: 20%;">{{email.subject}}</td>
          <td style="text-align: left; width: 20%;">{{email.status}}</td>
        </tr>
        </tbody>
      </table>
      <br/>
      <br/>
      <p>Total emails sent: {{emails.length}}</p>
    </div>
  </div>
</template>

<script>
import axios from "axios"
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

export default {
    name: 'List',
    data() {
        return {
            emails: [],
            search: '',
            status: 'sent'
        }
    },
    created() {
    axios.get(`http://mailersend.test/jsonemails`)
    .then(response => {
        this.emails = response.data
    })
    .catch(e => {
        this.errors.push(e)
    })
  },
  computed: {
    filteredList() {
      return this.emails.filter(email => {
        return (email.subject.toLowerCase().includes(this.search.toLowerCase()) ||
              email.emailFrom.toLowerCase().includes(this.search.toLowerCase()) ||
              email.emailTo.toLowerCase().includes(this.search.toLowerCase())) &&
              email.status == this.status
      })
    }
  }
};
</script>