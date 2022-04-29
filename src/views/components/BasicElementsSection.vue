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
                  <div class="item">
                    <input type="checkbox" class="vendor" name="vendorType[]" value="1">
                    <label for="type1">New items </label>
                  </div>
                  <div class="item">
                  <input type="checkbox" class="vendor" name="vendorType[]" value="2">
                  <label for="type2">Used items </label>
                  </div>
                  <div class="item">
                  <input type="checkbox" class="vendor" name="vendorType[]" value="3">
                  <label for="type3">Recycled items </label>
                  </div>
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
              <md-option value="1"> Utensils </md-option>
              <md-option value="2"> Furniture </md-option>
              <md-option value="3"> Digital devices </md-option>
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
              <md-option value="500"> 500 meters </md-option>
              <md-option value="1000"> 1 kilometer </md-option>
              <md-option value="1001"> More than 1km </md-option>
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
          
          <div v-for="item in items" :key="item.message">
          <img
            v-bind:src="'http://localhost/ShopDock/vendor-images/' + item.Image"
            alt="Rounded Image"
            class="rounded"
            :class="{ 'responsive-image': responsive }"
          />
                <h4><b>Shop name: {{item.VendorName}} </b></h4>
                <h4>Address: {{item.Address}} </h4>
                <h4>Price range: {{item.PriceRange}} </h4>
                <h4>Working hours: {{item.WorkingHours}} </h4>
                <br>
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
      items: null,
      name: null,
      price: null,
      location: null,
      image: require("@/assets/img/faces/shopImg.jpg"),
      initial: null,
      floatingLabel: null,
      vendorType: null,
      LatLong: null,
      distance: 0,
      category: null,
      success: null,
      error: null,
      withMIcon: null,
      withFaIcon: null,
      checkbox1: true,
      checkbox2: null,
      checkbox3: true,
      checkbox4: null,
      switch1: null,
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
            //this.getStreetAddressFrom(position.coords.latitude,position.coords.longitude);
            this.LatLong = position.coords.latitude + "," + position.coords.longitude;
            this.search();
          },
          error => {
            console.log(error.message);
          },
      )
    },
    
    async mounted(){

    let result = await axios.get("http://localhost:8080/#/");
    console.log("result");
    
    },

  search(){

    var results;
    var vendors = document.querySelectorAll('.vendor:checked');
        this.vendorType = "";
        for(var i = 0; i < vendors.length ; i ++){
            if(i + 1 == vendors.length){
                this.vendorType += vendors[i].value;
            }else{
                this.vendorType += vendors[i].value + ",";
            }
        }
        console.log("vendor:" + this.vendorType);
        console.log("product:" + this.category);
        console.log("distance:" + this.distance);
        console.log("ltlng:" + this.LatLong);

        let formData = new FormData();
        formData.append('productType', this.vendorType);
        formData.append('category', this.category);
        formData.append('distance', this.distance);
        formData.append('userLatlng',this.LatLong);

        if(parseInt(this.distance) == 1001){
          formData.append('comparator', "more")
        }else{
          formData.append('comparator', "less")
        }
        var that = this;
         axios({
            method: 'post',
            url: 'http://localhost/ShopDock/vendor-search.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)
            if(response.data.code == "200"){
              window.location.href = 'http://localhost:8080/#/';
              
              that.items = response.data.message;

              that.name = response.data.message[0].VendorName;
              that.address = response.data.message[0].Address;
              that.price = response.data.message[0].PriceRange;
            }
            else{
              console.log("Data fetch failed!!!")
            }
        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });


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
