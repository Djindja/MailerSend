<template>
  <div>
    <div class="x_panel">
    <div class="x_title">
      List of all emails
    </div>

    <div class="col-md-6">
      <input v-model="search" class="form-control" type="text" placeholder="Search...">
    </div>

    <div class="x_content">

      <table class="table">
        <thead>
            <tr>
                <th style="text-align: left; width: 20%;">Email From</th>
                <th style="text-align: left; width: 20%;">Email To</th>
                <th style="text-align: left; width: 20%;">Subject</th>
                <th style="text-align: left; width: 20%;">Status</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="email in filteredList" :key="email.id">
            <td style="text-align: left; width: 20%;"><router-link :to="{ name: 'single', params: { mailId: email.id }}">{{ email.emailFrom }}</router-link></td>
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
  </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'List',
    data() {
        return {
            emails: [],
            search: '',
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
              email.emailTo.toLowerCase().includes(this.search.toLowerCase()))
      })
    }
  }
};
</script>