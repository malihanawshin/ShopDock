<template>
  <div class="wrapper">
    <parallax class="page-header header-filter" :style="headerStyle">
      <div class="md-layout">
        <div class="md-layout-item">
          <div class="image-wrapper">
            <div class="brand">
              <h1>ShopDock</h1>
              <h3>Every Business Matters</h3>
            </div>
          </div>
        </div>
      </div>
    </parallax>
    <div class="main main-raised">
      <div class="section section-basic">
        <div class="container">
          <div class="title">
            <h2>Search product</h2>
          </div>
          <basic-elements></basic-elements>
        </div>
      </div>

      <div class="section section-signup page-header" :style="signupImage">
        <div class="container">
          <div class="md-layout">
            <div
              class="md-layout-item md-size-33 md-medium-size-40 md-small-size-50 md-xsmall-size-70 mx-auto text-center"
            >
              <login-card header-color="green">
                <h4 slot="title" class="card-title">Small business owner?</h4>
                <h4 slot="title" class="card-title">Register here!</h4>
                                
                <md-field class="md-form-group" slot="inputs">
                  <md-icon>face</md-icon>
                  <label>Username...</label>
                  <md-input v-model="userName"></md-input>
                </md-field>
                <md-field class="md-form-group" slot="inputs">
                  <md-icon>email</md-icon>
                  <label>Email...</label>
                  <md-input v-model="email" type="email"></md-input>
                </md-field>
                <md-field class="md-form-group" slot="inputs">
                  <md-icon>lock_outline</md-icon>
                  <label>Password...</label>
                  <md-input v-model="password"></md-input>
                </md-field>
                <md-button slot="footer" class="md-simple md-success md-lg" @click= "register">
                  Get Started
                </md-button>
                <md-button slot="footer" class="md-simple md-success md-lg" href="#/login">
                Or Login
              </md-button>
              </login-card>
            </div>
          </div>
        </div>
      </div>
      
      </div>
  </div>
</template>

<script>
import BasicElements from "./components/BasicElementsSection";
import { LoginCard } from "@/components";
import { axios } from '@/plugins/axios'

export default {
  components: {
    BasicElements,
    LoginCard
  },
  name: "index",
  bodyClass: "index-page",
  props: {
    image: {
      type: String,
      default: require("@/assets/img/city-header.jpg")
    },
    signup: {
      type: String,
      default: require("@/assets/img/city.jpg")
    },
  },
  data() {
    return {
      userName: null,
      email: null,
      password: null,
      leafShow: false
    };
  },
  methods: {

    register() {
      let formData = new FormData();
        formData.append('userName', this.userName)
        formData.append('password', this.password)
        formData.append('email', this.email)
        
        var contact = {};
        formData.forEach(function(value, key){
            contact[key] = value;
        });

        axios({
            method: 'post',
            url: 'http://localhost/ShopDock/registration.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)
            if(response.data.code == "200"){
              //this.$router.push({name:'login'});
              window.location.href = 'http://localhost:8080/#/login';
            }
            else{
              console.log("Registration failed!!!")
            }
        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });
    },

  },
  computed: {
    headerStyle() {
      return {
        backgroundImage: `url(${this.image})`
      };
    },
    signupImage() {
      return {
        backgroundImage: `url(${this.signup})`
      };
    }
  }
  
};
</script>
<style lang="scss">
.section-download {
  .md-button + .md-button {
    margin-left: 5px;
  }
}

@media all and (min-width: 991px) {
  .btn-container {
    display: flex;
  }
}
</style>
