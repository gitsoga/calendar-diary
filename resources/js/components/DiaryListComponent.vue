<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>{{ yearMonth }}</h1>
      </div>
    </div>
    <div class="flexcontainer">
      <div v-for="n in spaceNum" class="flexitem border">
      </div>
      <div v-for="(item, index) in calendars" class="flexitem border">
        <div>{{ index }}</div>
        <div v-if="item.length !== 0">
          <div>{{ item.diary.slice(0, 20) }} <router-link v-bind:to="{name:'diary.show', params: { diaryId: item.id }}">全文見る</router-link></div>
          <div><router-link v-bind:to="{name:'diary.edit', params: { diaryId: item.id }}">日記を編集する</router-link></div>
        </div>
        <div v-else>
          <div><router-link v-bind:to="{name:'diary.create', params: { date: yearMonth +'-'+ ('00' + index ).slice( -2 ) }}">日記を書く</router-link></div>
        </div>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  data () {
    return {
      yearMonth: null,
      calendars: [],
      spaceNum: null,
      yearMonthLast: null,
      yearMonthNext: null,
    }
  },
  mounted () {
    axios
      .get('/api/showCalendar', {
        headers: { "X-Authorization": this.getToken() }
      })
      .then(response => {
        let self = this
        self.yearMonth = response.data.yearMonth;
        self.calendars = response.data.calendars;
        self.spaceNum = Number(response.data.spaceNum);
      })
  }
};
</script>

<style>
.flexcontainer {
  display: flex;
  flex-wrap: wrap;
}
.flexitem {
  width: calc(100%/7);
}
</style>
