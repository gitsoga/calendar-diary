<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h2>{{ date }}</h2>
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="diary" class="col-sm-3 col-form-label">本文</label>
            <textarea id="diary" :class="['col-sm-9', 'form-control', err.diary ? 'is-invalid' : '']" v-model="diary"></textarea>
            <span v-if="err.diary" :class="['invalid-feedback']">{{ err.diary[0] }}</span>
          </div>
          <div class="form-group row">
            <label for="image" class="col-sm-3 col-form-label">画像</label>
            <input type="file" id="image" @change="onFileChange" class="is-invalid">
            <span v-if="err.image" :class="['invalid-feedback']">{{ err.image[0] }}</span>
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
        diary: '',
        image: '',
        err: []
      }
    },
    methods: {
      onFileChange(e){
        this.image = e.target.files[0];
      },
      submit() {
        const form = new FormData();
        form.append('date', this.date);
        form.append('diary', this.diary);
        form.append('image_del_flg', 0);
        form.append('image', this.image);

        axios.post('/api/create', form, {
          headers: {
            'X-Authorization': this.getToken(),
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((res) => {
          this.$router.push({name: 'diary.list'});
        })
        .catch((error) => {
          this.err = error.response.data.errors;
        });
      }
    }
  }
</script>
