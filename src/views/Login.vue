<template>
  <div class="wrapper">
    <div class="section page-header header-filter" :style="headerStyle">
      <div class="container">
        <div class="md-layout">
          <div
            class="md-layout-item md-size-33 md-small-size-66 md-xsmall-size-100 md-medium-size-40 mx-auto"
          >
            <login-card header-color="green">
              <h4 slot="title" class="card-title">Login</h4>
              
              
              <p slot="description" class="description">Go business owners!</p>
              <md-field class="md-form-group" slot="inputs">
                <md-icon>face</md-icon>
                <label>Username...</label>
                <md-input v-model="userName"></md-input>
              </md-field>
              
              <md-field class="md-form-group" slot="inputs">
                <md-icon>lock_outline</md-icon>
                <label>Password...</label>
                <md-input v-model="password"></md-input>
              </md-field>
              <md-button @click= "login" slot="footer" class="md-simple md-success md-lg">
                Get Started
              </md-button>
            </login-card>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { LoginCard } from "@/components";
import { axios } from '@/plugins/axios';


export default {
  components: {
    LoginCard
  },
  bodyClass: "login-page",
  data() {
    return {
      userName: null,
      password: null
    };
  },
  props: {
    header: {
      type: String,
      default: require("@/assets/img/city-header.jpg")
    }
  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.header})`
      };
    }
  },
 
 methods: {
    login(){

      let formData = new FormData();
        formData.append('userName', this.userName);
        formData.append('password', this.password);

        var contact = {};
        formData.forEach(function(value, key){
            contact[key] = value;
        });

        axios({
            method: 'post',
            url: 'http://localhost/ShopDock/login.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)
            if(response.data.code == "200"){
              //this.$router.push({name:'profile'});
              window.location.href = 'http://localhost:8080/#/profile';
            }
            else{
              console.log("Login failed!!!")
            }
        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });

    }
 }


};
</script>

<style lang="css"></style>
