export default {
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
    }
}