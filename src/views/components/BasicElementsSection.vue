<template>
  <div class="wrapper">
    <div id="buttons">
      <div class="title">
        
      </div>  
    </div>
    <!-- end buttons -->
    
    

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
            <md-checkbox v-model="checkbox1">New product </md-checkbox>
            <md-checkbox v-model="checkbox2">Second hand product </md-checkbox>
            <md-checkbox v-model="checkbox3">Recycled product </md-checkbox
            >
          </div>
        </div>
        
        <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Choose category </h3>
          </div>
          <div class="flex-column">
            <md-radio v-model="radio1" :value="true" name="category"> Utensils </md-radio>
            <md-radio v-model="radio2" :value="true" name="category"> Furniture </md-radio>
            <md-radio v-model="radio3" :value="true" name="category"> Electronics </md-radio>
          </div>
        </div>

         <div
          class="md-layout-item md-size-25 md-xsmall-size-100 md-small-size-50 md-medium-size-25"
        >
          <div class="title">
            <h3>Select range </h3>
          </div>
          <div class="flex-column">
            <md-radio v-model="radio4" :value="true"> 500 meters </md-radio>
            <md-radio v-model="radio5" :value="false"> 1 kilometer </md-radio>
            <md-radio v-model="radio6" :value="true"> more than 1 km</md-radio>
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

  <div class="md-layout" align="center">
        <div class="md-layout-item md-size-66 mx-auto">
          <md-button class="md-primary"> Search </md-button>
        </div>
      </div>
</div>
</template>

<script>

export default {
  components: {
  },
  data() {
    return {
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
