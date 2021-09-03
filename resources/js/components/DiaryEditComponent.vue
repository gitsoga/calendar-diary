<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h2>{{ date }}</h2>
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="diary" class="col-sm-3 col-form-label">本文</label>
            <textarea id="diary" :class="['col-sm-9', 'form-control', err.diary ? 'is-invalid' : '']" rows="10" v-model="diary"></textarea>
            <span v-if="err.diary" :class="['invalid-feedback']">{{ err.diary[0] }}</span>
          </div>
          <div class="form-group row">
            <label for="image" class="col-sm-3 col-form-label">画像</label>
            <input type="file" id="image" @change="onFileChange" class="is-invalid">
            <span v-if="err.image" :class="['invalid-feedback']">{{ err.image[0] }}</span>
          </div>
          <div v-if="image_path" class="form-group row">
            <img :src="image_path" class="col-sm-9">
            <div class="col-sm-3">
              <button type="button" class="btn btn-info" v-on:click="imageDelete()">画像削除</button>
            </div>
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
      diaryId: Number,
    },
    data: function () {
      return {
        date: null,
        diary: '',
        image: '',
        image_del_flg: 0,
        image_path: null,
        err: [],
      }
    },
    methods: {
      getDiary() {
        axios.get('/api/edit/' + this.diaryId, {
          headers: { "X-Authorization": this.getToken() }
        })
        .then((res) => {
          this.date = res.data.date;
          this.diary = res.data.diary;
          this.image_path = res.data.image_path;
        });
      },
      onFileChange(e){
        e.preventDefault();
        this.image = e.target.files[0];
        this.image_path = null;
      },
      imageDelete() {
        this.image_del_flg = 1;
        this.image_path = null;
      },
      submit() {
        let form = new FormData();
        form.append('id', this.diaryId);
        form.append('date', this.date);
        form.append('diary', this.diary);
        form.append('image_del_flg', this.image_del_flg);
        form.append('image', this.image);

        axios.post('/api/edit/' + this.diaryId, form, {
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
    },
    mounted() {
        this.getDiary();
    }
  }
</script>
