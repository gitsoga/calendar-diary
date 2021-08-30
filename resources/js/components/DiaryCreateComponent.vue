<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="diary" class="col-sm-3 col-form-label">日記</label>
            <textarea id="diary" class="col-sm-9 form-control" v-model="diary"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">投稿</button>
          </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      date: String
    },
    data: function () {
      return {
        diary: ''
      }
    },
    methods: {
      submit() {
        const form = new FormData();
        form.append('date', this.date);
        form.append('diary', this.diary);

        axios.post('/api/create', form, {
          headers: { "X-Authorization": this.getToken() }
        })
        .then((res) => {
          this.$router.push({name: 'diary.list'});
        });
      }
    }
  }
</script>
