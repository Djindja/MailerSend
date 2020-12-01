<template>
    <div v-if="email !== null" class="col-12 col-md-10 col-lg-7-">
        <div class="list-group list-group-flush">
            Email subject is: {{email.subject}}
        </div>
    </div>
</template>

<script>

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