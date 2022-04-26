<template>
  <div class="wrapper">
    <parallax class="page-header header-filter" :style="headerStyle">
      <div class="md-layout">
        <div class="md-layout-item">
          <div class="image-wrapper">
            <img :src="leaf4" alt="leaf4" class="leaf4" v-show="leafShow" />
            <img :src="leaf3" alt="leaf3" class="leaf3" v-show="leafShow" />
            <img :src="leaf2" alt="leaf2" class="leaf2" v-show="leafShow" />
            <img :src="leaf1" alt="leaf1" class="leaf1" v-show="leafShow" />
            <div class="brand">
              <h1>ShopDock</h1>
              <h3>Small Business. New Residents</h3>
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
      <div class="section section-navbars">
        <div class="container">
          <small-navigation></small-navigation>
        </div>
        <navigation></navigation>
      </div>
      <div class="section section-tabs">
        <div class="container">
          <tabs></tabs>
        </div>
      </div>
      <div class="section section-white">
        <div class="container">
          <nav-pills></nav-pills>
        </div>
      </div>
      
      <div class="section">
        <div class="container">
          <typography-images></typography-images>
        </div>
      </div>
      <div class="section section-javascript">
        <div class="container">
          <javascript-components></javascript-components>
        </div>
      </div>

      <div class="section section-signup page-header" :style="signupImage">
        <div class="container">
          <div class="md-layout">
            <div
              class="md-layout-item md-size-33 md-medium-size-40 md-small-size-50 md-xsmall-size-70 mx-auto text-center"
            >
              <login-card header-color="green">
                <h4 slot="title" class="card-title">Login</h4>
                <md-button
                  slot="buttons"
                  href="javascript:void(0)"
                  class="md-just-icon md-simple md-white"
                >
                  <i class="fab fa-facebook-square"></i>
                </md-button>
                <md-button
                  slot="buttons"
                  href="javascript:void(0)"
                  class="md-just-icon md-simple md-white"
                >
                  <i class="fab fa-twitter"></i>
                </md-button>
                <md-button
                  slot="buttons"
                  href="javascript:void(0)"
                  class="md-just-icon md-simple md-white"
                >
                  <i class="fab fa-google-plus-g"></i>
                </md-button>
                <p slot="description" class="description">Or Be Classical</p>
                <md-field class="md-form-group" slot="inputs">
                  <md-icon>face</md-icon>
                  <label>First Name...</label>
                  <md-input v-model="firstname"></md-input>
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
                <md-button slot="footer" class="md-simple md-success md-lg">
                  Get Started
                </md-button>
              </login-card>
            </div>
          </div>
        </div>
      </div>
      <div class="md-layout">
        <div class="md-layout-item text-center">
          <md-button href="#/login" class="md-simple md-success md-lg"
            >View Login Page</md-button
          >
        </div>
      </div>
      <div class="section section-examples">
        <div class="container-fluid text-center">
          <div class="md-layout">
            <div class="md-layout-item">
              <a href="#/landing" target="_blank">
                <img
                  :src="landing"
                  alt="Rounded Image"
                  class="img-raised rounded img-fluid"
                />
              </a>
              <md-button href="#/landing" class="md-simple md-success md-lg"
                >View Landing Page</md-button
              >
            </div>
            <div class="md-layout-item">
              <a href="#/profile" target="_blank">
                <img
                  :src="profile"
                  alt="Rounded Image"
                  class="img-raised rounded img-fluid"
                />
              </a>
              <md-button href="#/profile" class="md-simple md-success md-lg"
                >View Profile Page</md-button
              >
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
      default: require("@/assets/img/vue-mk-header.jpg")
    },
    leaf4: {
      type: String,
      default: require("@/assets/img/leaf4.png")
    },
    leaf3: {
      type: String,
      default: require("@/assets/img/leaf3.png")
    },
    leaf2: {
      type: String,
      default: require("@/assets/img/leaf2.png")
    },
    leaf1: {
      type: String,
      default: require("@/assets/img/leaf1.png")
    },
    signup: {
      type: String,
      default: require("@/assets/img/city.jpg")
    },
    landing: {
      type: String,
      default: require("@/assets/img/landing.jpg")
    },
    profile: {
      type: String,
      default: require("@/assets/img/profile.jpg")
    }
  },
  data() {
    return {
      firstname: null,
      email: null,
      password: null,
      leafShow: false
    };
  },
  methods: {
    leafActive() {
      if (window.innerWidth < 768) {
        this.leafShow = false;
      } else {
        this.leafShow = true;
      }
    }
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
  },
  mounted() {
    this.leafActive();
    window.addEventListener("resize", this.leafActive);
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.leafActive);
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
