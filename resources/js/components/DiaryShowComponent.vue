<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h2>{{ date }}</h2>
        <form>
          <div class="form-group row">
            <label for="diary" class="col-sm-3 col-form-label">本文</label>
            <textarea id="diary" class="col-sm-9 form-control" v-model="diary" rows="20" readonly></textarea>
          </div>
          <div class="form-group row" v-if="image_path">
            <label for="image" class="col-sm-3 col-form-label">画像</label>
            <img :src="image_path" class="col-sm-9">
          </div>
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
        image_path: null,
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
    },
    mounted() {
        this.getDiary();
    }
  }
</script>
