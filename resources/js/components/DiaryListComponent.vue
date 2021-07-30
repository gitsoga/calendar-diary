<template>
  <div class="container-fluid">
    <h1>{{ yearMonth }}</h1>
    <div class="row seven-cols">
      <div v-for="n in spaceNum" class="col-md-1 border">
      </div>
      <div v-for="(item, index) in calendars" class="col-md-1 border">
        <div>{{ index }}</div>
        <div v-if="item.length !== 0">
          <div>{{ item.diary }}</div>
          <div><router-link to="/edit">日記を編集する</router-link></div>
        </div>
        <div v-else>
          <div><a href="">日記を書く</a></div>
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
    }
  },
  methods: {
    getToken: function () {
      const cognitoUser = this.$cognito.userPool.getCurrentUser();
      cognitoUser.getSession(function (err, session) {
        window.session = session;
        if (err) {
          alert(err);
          return;
        }
      });
      return session.getAccessToken().getJwtToken();
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
        self.spaceNum = response.data.spaceNum;
      })
  }
};
</script>

<style>
</style>
