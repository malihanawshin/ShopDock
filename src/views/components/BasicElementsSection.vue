<template>
  <div class="wrapper">

    <!-- Checkboxes/Radios/Toggle -->
    <div id="checkRadios">
      <div class="md-layout">
        <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Choose product type </h3>
          </div>
          <div class="flex-column">
            <md-checkbox v-model="checkbox1" value="false"> New product </md-checkbox>
            <md-checkbox v-model="checkbox2" value="false"> Second hand product </md-checkbox>
            <md-checkbox v-model="checkbox3" value="false"> Recycled product </md-checkbox>
          </div>
        </div>
        
        <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Choose category </h3>
          </div>
          <div class="flex-column">
          <md-field>
            <md-select v-model="category" name="category" id="category">
              <md-option value="utensils">Utensils</md-option>
              <md-option value="furniture">Furniture</md-option>
              <md-option value="devices">Digital devices</md-option>
              </md-select>
              </md-field>
          </div>
        </div>

         <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Select distance range </h3>
          </div>
          <div class="flex-column">
            <md-field>
            <md-select v-model="distance" name="distance" id="distance">
              <md-option value="500m">500 meters </md-option>
              <md-option value="1km">1 kilometer </md-option>
              <md-option value="more">More than 1km </md-option>
              </md-select>
              </md-field>
          </div>
        </div>

        <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Search Results </h3>
          </div>
          <div class="flex-column">
            <md-switch v-model="switch1">Nearest first </md-switch>
            <md-switch v-model="switch2">Cheapest fisrt </md-switch>
          </div>
        </div>
      </div>
    </div>
    <!-- end Checkboxes/Radios/Toggle -->

  <div class="space-50"></div>

  
      <div class= "md-layout" align="center">
         <form class="ui segment large form" align="center">
            <div class="field" align="center">
               <div class="ui right icon input large" align="center">
                  <input
                     type="text"
                     placeholder="Enter your address"
                     v-model="address"
                     ref="autocomplete"
                     />
                  <i class="dot circle link icon" @click="getUserLocation"></i>
               </div>
            </div>
         </form>
      </div>
<div class="space-30"></div>

  <div class="md-layout" align="center">
        <div class="md-layout-item md-size-66 mx-auto">
          <md-button class="md-primary" @click="getUserLocation"> Search </md-button>
        </div>
      </div>

<div class="space-40"></div>

<div class="md-layout">
        <div
          class="md-layout-item md-size-20 md-xsmall-size-100"
          :class="{ 'text-center': responsive }"
        >
          
          <img
            :src="image"
            alt="Rounded Image"
            class="rounded"
            :class="{ 'responsive-image': responsive }"
          />
          <div>
            <h4>Shop name: </h4>
            <h4>Location: </h4>
            <h4>Price range: </h4>
          </div>

        </div>
  </div>

  </div>

</template>

<script>
import { axios } from '@/plugins/axios'

export default {
  components: {
  },
  data() {
    return {
      image: require("@/assets/img/faces/shopImg.jpg"),
      initial: null,
      floatingLabel: null,
      success: null,
      error: null,
      withMIcon: null,
      withFaIcon: null,
      checkbox1: true,
      checkbox2: null,
      checkbox3: true,
      checkbox4: null,
      radio1: true,
      radio2: false,
      switch1: true,
      switch2: null,
      amount: 30,
      amount2: 60,
      buffer: 40,
      sliders: {
        simple: 40,
        rangeSlider: [20, 60]
      }
    };
  },

  methods: {
      getUserLocation(){
        navigator.geolocation.getCurrentPosition(
          position => {
            console.log(position.coords.latitude);
            console.log(position.coords.longitude);
            this.getStreetAddressFrom(position.coords.latitude,position.coords.longitude);
          },
          error => {
            console.log(error.message);
          },
      )
    },

  async getStreetAddressFrom(lat, long) {
   try {
      var {
         data
      } = await axios.get(
         "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
         lat +
         "," +
         long +
         "&key={AIzaSyBa_GXjj0sD7Kz-CxCH_mFJ6b_KeEJWI7k}"
      );
      if (data.error_message) {
         console.log(data.error_message)
      } else {
         this.address = data.results[0].formatted_address;
      }
   } catch (error) {
      console.log(error.message);
   }
}

  }

};
</script>

<style lang="scss" scoped>
.vertical-center {
  display: flex;
  align-items: center;
}
.flex-column {
  display: flex;
  flex-direction: column;
}
.md-checkbox,
.md-radio {
  display: flex;
  margin: 0;
  margin-bottom: 0.5rem;
}
</style>
