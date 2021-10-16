<template>
  <div>
    <div v-if="step === 1">
      <h2>What Are <b>You Shipping?</b></h2>

      <div class="cars">
        <h3 class="has-text-weight-bold has-text-dark has-text-left">Your car model</h3>
        <div v-for="(vehicle, index) in vehicles" :key="'vehicle-' + index" class="single-car">
          <div class="field is-horizontal">
            <div class="field-body">

              <div class="field">
                <div class="dropdown is-flex is-align-items-center control is-large">
                  <input class="input is-large" type="text" placeholder="Year" :value="vehicle.year" @focus="vehicle.year_focus = true" @blur="vehicle.year_focus = false" readonly/>
                  <div :class="['dropdown-menu', vehicle.year_focus ? 'is-active' : null]" role="menu">
                    <div class="dropdown-content">
                      <a v-for="item in year_options" :class="['dropdown-item', vehicle.year === item ? 'is-active' : null]" :key="'item-year-' + item" @click="vehicle.year = item">
                        {{ item }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="field">
                <div class="dropdown is-flex is-align-items-center control is-large">
                  <input class="input is-large" type="text" placeholder="Make" v-model="vehicle.make_value" @input="getMake(vehicle)" @focus="vehicle.make_focus = true" @blur="vehicle.make_focus = false"/>
                  <div v-if="!vehicle.loading && vehicle.make_options.length" :class="['dropdown-menu', vehicle.make_focus ? 'is-active' : null]" role="menu">
                    <div class="dropdown-content">
                      <a v-for="item in vehicle.make_options" :class="['dropdown-item', vehicle.make === item ? 'is-active' : null]" :key="'item-make-' + item.id" @click="selectMake(vehicle, item)">
                        {{ item.make }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="field">
                <div class="dropdown is-flex is-align-items-center control is-large">
                  <input v-if="vehicle.model.id === -1" class="input is-large" type="text" placeholder="Model" v-model="vehicle.model.model" @focus="vehicle.model_focus = true" @blur="vehicle.model_focus = false"/>
                  <input v-else class="input is-large" type="text" placeholder="Model" :value="vehicle.model.model" @focus="vehicle.model_focus = true" @blur="vehicle.model_focus = false" readonly/>
                  <div v-if="!vehicle.loading && vehicle.model_options.length" :class="['dropdown-menu', vehicle.model_focus ? 'is-active' : null]" role="menu">
                    <div class="dropdown-content">
                      <a v-for="item in vehicle.model_options" :class="['dropdown-item', vehicle.model.id === item.id ? 'is-active' : null]" :key="'item-model-' + item.id" @click="vehicle.model = (item.id === -1 ? {id: item.id, model: ''} : item)">
                        <template v-if="item.id === -1"><b>{{ item.model }}</b></template>
                        <template v-else>{{ item.model }}</template>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="field is-horizontal checkboxes">
            <div class="field-body">

              <div class="field">
                <input type="checkbox" :id="'checkbox-operable-' + index" v-model="vehicle.operable">
                <label :for="'checkbox-operable-' + index">
                  <span class="text">Operables</span>
                  <span class="help">Runs & drivers</span>
                </label>
              </div>

              <div class="field">
                <input type="checkbox" :id="'checkbox-convertible-' + index" v-model="vehicle.convertible">
                <label :for="'checkbox-convertible-' + index">
                  <span class="text">Convertible</span>
                  <span class="help">Open top, or no roof</span>
                </label>
              </div>

              <div class="field">
                <input type="checkbox" :id="'checkbox-modified-' + index" v-model="vehicle.modified">
                <label :for="'checkbox-modified-' + index">
                  <span class="text">Modified</span>
                  <span class="help">Lift kits, large tires, extra weight, etc</span>
                </label>
              </div>

            </div>
          </div>

          <button v-if="index !== 0" class="removeButton" @click="vehicles.splice(index, 1)">
            <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
              <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
            </svg>
          </button>

        </div>
        <button class="button is-rounded add-vehicle" @click="addVehicle">Add one more vehicle</button>
        <p v-if="vehicles_validation" class="error">{{ vehicles_validation }}</p>
      </div>

      <div class="zips">
        <div class="field is-horizontal">
          <div class="field-body">
            <div class="field from">
              <h3 class="has-text-weight-bold has-text-dark has-text-left">Pickup location</h3>
              <div class="field">
                <div :class="['dropdown', 'is-flex', 'is-align-items-center', 'control', 'is-large', zip.from.loading ? 'is-loading' : null]">
                  <point width="24"/>
                  <input class="input is-large" type="text" placeholder="Zip From" v-model="zip.from.value" @input="getOrderForm('from')" @focus="zip.from.focus = true" @blur="zip.from.focus = false" autocomplete="nope"/>
                  <div v-if="zip.from.validation" class="error">{{ zip.from.validation }}</div>
                  <div v-if="!zip.from.loading && zip.from.array.length" :class="['dropdown-menu', zip.from.focus ? 'is-active' : null]" role="menu">
                    <div class="dropdown-content">
                      <a v-for="item in zip.from.array" :class="['dropdown-item', zip.from.data.id === item.id ? 'is-active' : null]" :key="'item-from-' + item.id" @click="selectCity('from', item)">
                        {{ item.city }}, {{ item.state }}, {{ item.zip }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="field to">
              <h3 class="has-text-weight-bold has-text-dark has-text-left">Delivery location</h3>
              <div class="field">
                <div :class="['dropdown', 'is-flex', 'is-align-items-center', 'control', 'is-large', zip.to.loading ? 'is-loading' : null]">
                  <point width="24"/>
                  <input class="input is-large" type="text" placeholder="Zip To" v-model="zip.to.value" @input="getOrderForm('to')" @focus="zip.to.focus = true" @blur="zip.to.focus = false" autocomplete="nope"/>
                  <div v-if="zip.to.validation" class="error">{{ zip.to.validation }}</div>
                  <div v-if="!zip.to.loading && zip.to.array.length" :class="['dropdown-menu', zip.to.focus ? 'is-active' : null]" role="menu">
                    <div class="dropdown-content">
                      <a v-for="item in zip.to.array" :class="['dropdown-item', zip.to.data.id === item.id ? 'is-active' : null]" :key="'item-to-' + item.id" @click="selectCity('to', item)">
                        {{ item.city }}, {{ item.state }}, {{ item.zip }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button :class="['submit', 'button', 'is-large', submitLoading ? 'is-loading' : null]" @click="submitForm">Get Quotes</button>
    </div>
    <div v-else-if="step === 2">
      <h2>When Do <b>You Need Your Vehicle to Be Shipped?</b></h2>
      <div class="steps">
        <span class="link" @click="step = 1">1</span>
        <span class="link current">2</span>
        <span>3</span>
      </div>
      <div class="date">
        <div class="detail">
          <div class="control">
            <label class="radio">
              <input type="radio" name="dateDetail" value="On one particular date" v-model="dateDetail">
              On one particular date
            </label>
            <label class="radio">
              <input type="radio" name="dateDetail" value="I'm flexible" v-model="dateDetail">
              I'm flexible
            </label>
            <label class="radio">
              <input type="radio" name="dateDetail" value="In the next few days" v-model="dateDetail">
              In the next few days
            </label>
            <label class="radio">
              <input type="radio" name="dateDetail" value="As soon as possible" v-model="dateDetail">
              As soon as possible
            </label>
          </div>
        </div>
        <div :class="['calendar', dateDetail !== 'On one particular date' ? 'disabled' : null]">
          <v-date-picker :min-date="today" v-model="date" locale="en-US" is-required/>
        </div>
      </div>
      <button :class="['submit', 'button', 'is-large', submitLoading ? 'is-loading' : null]" @click="submitForm">Next</button>
    </div>
    <div v-else-if="step === 3">
      <h2>The <b>Final Step</b></h2>
      <step2SVG width="140"/>
      <div class="steps">
        <span class="link" @click="step = 1">1</span>
        <span class="link" @click="step = 2">2</span>
        <span class="link current">3</span>
      </div>
      <div class="info">
        <div class="form-field is-flex is-justify-content-center is-align-items-center">
          <div class="field">
            <input v-model="name.value" :class="['input', 'is-large', name.validation ? 'is-danger' : null]" type="text" placeholder="Name" autocomplete="nope"/>
            <p v-if="name.validation" class="error">{{ name.validation }}</p>
          </div>
          <div class="contact">
            <div class="field">
              <input v-model="phone.value" :class="['input', 'is-large', phone.validation ? 'is-danger' : null]" v-input-mask data-inputmask="'mask': '(999)-999-9999', 'placeholder': '0'" type="text" placeholder="Phone" autocomplete="nope"/>
              <p v-if="phone.validation" class="error">{{ phone.validation }}</p>
            </div>
<!--            <span class="is-dark has-text-dark has-text-weight-bold">or</span>-->
            <div class="field">
              <input v-model="email.value" :class="['input', 'is-large', email.validation ? 'is-danger' : null]" type="email" placeholder="Email" autocomplete="nope"/>
              <p v-if="email.validation" class="error">{{ email.validation }}</p>
            </div>
          </div>
        </div>
      </div>
      <button :class="['submit', 'button', 'is-large', submitLoading ? 'is-loading' : null]" @click="submitForm">Get Quotes</button>
    </div>
    <div v-else-if="step === 4" class="step-4">
      <h2>Your order has been submitted</h2>
      <p>Wait for the call soon!</p>
      <div class="buttons">
        <button class="submit button is-large" @click="goToProfile">Bid the cost</button>
        <button class="submit button is-large cancel" @click="closeModal">Send more</button>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import point from './includes/svg/point'
import step2SVG from './includes/svg/step2'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import _ from 'lodash'

export default {
  data() {
    return {
      source: 'car-modal',
      today: new Date(),
      step: 1,
      order_id: null,
      submitLoading: false,
      name: {validation: null, value: ''},
      email: {validation: null, value: ''},
      phone: {validation: null, value: ''},
      zip: {
        from: {data: {id: null, city: null, state: null, zip: null}, validation: null, value: '', focus: false, loading: false, array: []},
        to: {data: {id: null, city: null, state: null, zip: null}, validation: null, value: '', focus: false, loading: false, array: []}
      },
      vehicles: [],
      vehicles_validation: null,
      year_options: _.range(new Date().getFullYear(), 1969),
      date: new Date(),
      dateDetail: 'On one particular date'
    }
  },
  components: {
    'v-date-picker': DatePicker,
    point,
    step2SVG
  },
  mounted() {
    this.GET_STEP({source: this.source}).then(data => {
      if(data.step === 1) {
        this.clearStep(data.step)
      } else if (data.step === 2) {
        this.zip.from.data = data.from
        this.zip.from.value = `${data.from.city}, ${data.from.state}, ${data.from.zip}`
        this.zip.to.data = data.to
        this.zip.to.value = `${data.to.city}, ${data.to.state}, ${data.to.zip}`
        this.vehicles = data.vehicles.map(function (vehicle) {
          return {
            year: vehicle.year,
            year_focus: false,
            make_value: vehicle.make.make,
            make: vehicle.make,
            make_focus: false,
            make_options: [],
            model: vehicle.model,
            model_focus: false,
            model_options: [],
            operable: vehicle.operable,
            convertible: vehicle.convertible,
            modified: vehicle.modified,
            loading: false
          }
        })
        this.clearStep(data.step)
      } else if (data.step === 3) {
        this.zip.from.data = data.from
        this.zip.from.value = `${data.from.city}, ${data.from.state}, ${data.from.zip}`
        this.zip.to.data = data.to
        this.zip.to.value = `${data.to.city}, ${data.to.state}, ${data.to.zip}`
        this.vehicles = data.vehicles.map(function (vehicle) {
          return {
            year: vehicle.year,
            year_focus: false,
            make_value: vehicle.make.make,
            make: vehicle.make,
            make_focus: false,
            make_options: [],
            model: vehicle.model,
            model_focus: false,
            model_options: [],
            operable: vehicle.operable,
            convertible: vehicle.convertible,
            modified: vehicle.modified,
            loading: false
          }
        })
        this.date = data.date
        this.dateDetail = data.dateDetail
        this.clearStep(data.step)
      }
      this.step = data.step
    })
  },
  methods: {
    ...mapActions([
      'GET_STEP',
      'SEND_FORM',
      'GET_CITY',
      'GET_MAKE',
      'GET_MODEL'
    ]),
    clearStep(step) {
      if(step === 1) {
        this.clearValidation()
        this.clearZips()
        this.name.value = null
        this.email.value = null
        this.phone.value = null
        this.vehicles = [this.newVehicle()]
        this.date = new Date()
        this.dateDetail = 'On one particular date'
        this.order_id = null
      } else if (step === 2) {
        this.clearValidation()
        this.name.value = null
        this.email.value = null
        this.phone.value = null
        this.date = new Date()
        this.dateDetail = 'On one particular date'
        this.order_id = null
      } else if (step === 3) {
        this.clearValidation()
        this.name.value = null
        this.email.value = null
        this.phone.value = null
        this.order_id = null
      }
    },
    clearZips() {
      ['to', 'from'].map(function(name) {
        this.zip[name].data = {
          id: null,
          city: null,
          state: null,
          zip: null,
        }
      }, this)
    },
    clearValidation() {
      this.name.validation = null
      this.phone.validation = null
      this.email.validation = null
      this.zip.from.validation = null
      this.zip.to.validation = null
      this.vehicles_validation = null
    },
    selectCity(type, item) {
      this.zip[type].value = `${item.city}, ${item.state}, ${item.zip}`
      this.zip[type].data = item
    },
    getOrderForm(type) {
      let zip = this.zip[type]
      zip.array = []
      zip.validation = null
      if (zip.value.length > 2) {
        zip.loading = true
        this.GET_CITY(zip.value.split(',')[0]).then(data => {
          zip.array = data;
          zip.loading = false
        })
      } else {
        zip.data = {
          id: null,
          city: null,
          state: null,
          zip: null,
        }
      }
    },
    getMake(vehicle) {
      vehicle.make_options = []
      if(vehicle.make_value.length > 2) {
        vehicle.loading = true
        vehicle.make = {id: null, make: null}
        vehicle.model_options = []
        vehicle.model = {id: null, model: null}
        this.GET_MAKE({name: vehicle.make_value}).then(data => {
          vehicle.make_options = data
          vehicle.loading = false
        })
      }
    },
    getModel(vehicle, make) {
      vehicle.model_options = []
      vehicle.model = {id: null, model: null}
      this.GET_MODEL({name: make}).then(data => {
        vehicle.model_options = data
      })
    },
    selectMake(vehicle, item) {
      vehicle.make_value = item.make
      vehicle.make = item
      this.getModel(vehicle, item.make)
    },
    newVehicle() {
      return {
        year: new Date().getFullYear(),
        year_focus: false,
        make_value: null,
        make: {
          id: null,
          make: null
        },
        make_focus: false,
        make_options: [],
        model: {
          id: null,
          model: null
        },
        model_focus: false,
        model_options: [],
        operable: false,
        convertible: false,
        modified: false,
        loading: false
      }
    },
    addVehicle() {
      this.vehicles.push(this.newVehicle())
    },
    submitForm() {
      let formData
      this.submitLoading = true
      this.clearValidation()

      if(this.step === 1) {
        formData = {
          source: this.source,
          step: 1,
          from: this.zip.from.value === '' || !this.zip.from.data.id ? null : this.zip.from.data,
          to: this.zip.to.value === '' || !this.zip.to.data.id ? null : this.zip.to.data,
          vehicles: this.vehicles.map(function (vehicle) {
            return {year: vehicle.year, make: vehicle.make.make, model: vehicle.model.model, operable: vehicle.operable, convertible: vehicle.convertible, modified: vehicle.modified}
          }),
        }
      } else if (this.step === 2) {
        formData = {
          source: this.source,
          step: 2,
          date: this.date,
          dateDetail: this.dateDetail
        }
      } else if (this.step === 3) {
        formData = {
          source: this.source,
          step: 3,
          name: this.name.value,
          email: this.email.value,
          phone: this.phone.value
        }
      }

      this.SEND_FORM(formData).then(data => {
        if(this.step === 3) {
          this.step = 4
          this.order_id = data.order_id
          this.submitLoading = false
        } else {
          this.step++
          this.submitLoading = false
        }
      }).catch(error => {
        'from' in error.errors ? this.zip.from.validation = error.errors.from[0] : null
        'to' in error.errors ? this.zip.to.validation = error.errors.to[0] : null
        'name' in error.errors ? this.name.validation = error.errors.name[0] : null
        'email' in error.errors ? this.email.validation = error.errors.email[0] : null
        'phone' in error.errors ? this.phone.validation = error.errors.phone[0] : null
        Object.entries(error.errors).map(function(field) {
          field[0].indexOf('vehicles') !== -1 ? this.vehicles_validation = field[1][0] : null
        }, this)
        this.submitLoading = false
      })
    },
    goToProfile() {
      document.location.href = `${window.location.origin}/order/${this.order_id}`
    },
    closeModal() {
      this.clearStep(1)
      this.step = 1
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../sass/include/mixin";

::v-deep {

  h2 {
    margin-bottom: 1.5rem;
    @include media-lg {
      font-size: 2rem !important;
    }
    @include media-md {
      font-size: 1.6rem !important;
    }
    @include media-sm {
      font-size: 1.4rem !important;
    }
  }

  h3 {
    margin-bottom: .75rem;
    @include media-lg {
      font-size: 1rem !important;
      line-height: 1;
    }
  }

  .steps {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
    span {
      width: 42px;
      height: 42px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 10rem;
      margin: 0 30px;
      font-weight: 600;
      @include media-sm {
        margin: 0 15px;
      }
      @include media-xs {
        width: 32px;
        height: 32px;
        font-size: .875rem;
      }
      &:not(.link) {
        cursor: default;
        background: #E9E9ED;
        color: #272346;
        &:before {
          background: #E9E9ED;
        }
      }
      &.link {
        background: #F63E41;
        color: white;
        &:not(.current) {
          cursor: pointer;
        }
        &.current {
          cursor: default;
        }
        &:before {
          background: #F63E41;
        }
      }
      &:not(:first-child) {
        position: relative;
        &:before {
          content: '';
          position: absolute;
          left: -36px;
          top: 50%;
          transform: translate(0, -50%);
          width: 20px;
          height: 3px;
          border-radius: 3px;
          @include media-sm {
            left: -21px;
            width: 11px;
          }
          @include media-xs {
            height: 2px;
          }
        }
      }
    }
  }

  .error {
    position: absolute;
    bottom: -22px;
    color: #F63E41 !important;
    left: 0;
    font-size: 0.75rem !important;
    text-align: center;
    width: 100%;
  }

  .submit {
    &.button {
      font-size: 1rem;
      font-weight: bold;
      background: #F63E41;
      color: white;
      border: 0;
      border-radius: 10rem;
      box-shadow: none;
      min-width: 270px;
      height: 50px;
      margin-top: 2rem;
      @include media-xs {
        min-width: auto;
        padding: 0 1.5rem;
        height: 40px;
        margin-top: 1.5rem;
        font-size: .85rem;
      }
    }
  }

  input.input {
    &:focus, &.is-focused, &:active, &:hover, .is-active {
      border-color: #b5b5b5 !important;
    }
  }

  .add-vehicle {
    &.button {
      display: block;
      width: 100%;
      background: #E9E9ED;
      font-weight: bold;
      color: #272346;
      font-size: .875rem;
      box-shadow: none !important;
      border: 0;
      min-height: 50px;
      margin-top: 1.5rem;
      @include media-sm {
        margin-top: 1rem;
      }
      @include media-xs {
        min-width: auto;
        padding: 0 1.5rem;
        height: 40px;
        margin: 1rem auto 0 auto;
        font-size: .75rem;
        width: auto;
        min-height: 40px;
      }
      &:before {
        content: "+";
        width: .8125rem;
        height: .8125rem;
        background: #272346;
        font-weight: bold;
        color: white;
        font-size: .7rem;
        display: inline-flex;
        border-radius: 1rem;
        margin: 0 .5rem 0 0;
        justify-content: center;
        align-items: center;
        vertical-align: text-bottom;
      }
    }
  }

  .dropdown-menu {
    display: block;
    opacity: 0;
    visibility: hidden;
    width: 100%;
    transition: opacity .3s ease, visibility .3s ease;

    .dropdown-content {
      max-height: 213px;
      overflow-x: hidden;
    }

    &.is-active {
      opacity: 1;
      visibility: visible;
    }
    .dropdown-item {
      text-align: left;
      font-size: .875rem;
      padding: .6rem 1rem;
      background-color: white;
      transition: background-color .3s ease, color .3s ease;
      text-decoration: none !important;
      &:hover {
        background: rgba(39, 35, 70, 0.05);
        color: #83818F !important;
      }
      &.is-active {
        background-color: #423E5D;
        color: white !important;
      }
    }
  }

  .cars {
    border-bottom: 1px solid #DEDEE3;
    padding-bottom: 2rem;
    margin-bottom: 1.5rem;
    position: relative;

    .error {
      bottom: 7px;
    }

    .single-car {
      position: relative;
      &:not(.first-child) {
        margin-top: 1rem;
      }
      .removeButton {
        position: absolute;
        right: -30px;
        top: 50%;
        transform: translate(0, -50%);
        border: 0;
        background: transparent;
        display: flex;
        padding: 0;
        cursor: pointer;
        outline: none;
        svg {
          width: 13px;
          fill: #F63E41;
        }
      }
    }

    .checkboxes {
      .field {
        text-align: left;
        margin: 0 1rem;
        flex: 0 0 calc(100% / 3 - 2rem);
        cursor: pointer;
        @include media-xs {
          margin: 0;
        }
        input {
          cursor: pointer;
        }
        label {
          cursor: pointer;
          user-select: none;
          @include media-xs {
            font-size: .85rem;
          }
          .text {
            line-height: 1;
            position: relative;
            top: -1px;
            margin-left: .5rem;
            color: #272346;
            font-weight: 600;
          }
          .help {
            margin-top: 0;
            margin-left: 1.6rem;
            line-height: 1.2;
            @include media-xs {
              font-size: .65rem;
            }
          }
        }
      }
    }

    .field {
      input.input {
        min-height: 50px;
        padding-left: 1.5rem;
        font-size: 1rem;
        border-radius: 10rem;
        box-shadow: none;
        @include media-sm {
          min-height: 40px;
          font-size: .875rem;
        }
      }
    }
  }

  .zips {
    .to, .from {
      .error {
        @include media-xs {
          width: auto;
          left: unset;
          right: 20px;
          bottom: -14px;
          font-size: .6rem !important;
        }
      }
      .dropdown {
        position: relative;
        svg {
          position: absolute;
          z-index: 10;
          left: 14px;
          width: 20px;
          @include media-sm {
            width: 15px;
          }
        }
        input.input {
          min-height: 50px;
          padding-left: 3rem;
          font-size: 1rem;
          border-radius: 10rem;
          box-shadow: none;
          @include media-sm {
            min-height: 40px;
            font-size: .875rem;
            padding-left: 2.5rem;
          }
        }
      }
    }
  }

  .date {
    display: flex;

    @include media-sm {
      flex-direction: column;
    }

    .detail, .calendar {
      flex: 0 0 50%;
    }

    .detail {
      padding-top: 2rem;
      padding-left: 2rem;

      @include media-sm {
        padding-top: 0;
      }

      .control {
        display: flex;
        flex-direction: column;

        label {
          margin-left: 0;
          margin-bottom: .5rem;
          font-size: 1rem;
          display: flex;
          align-items: center;
          color: #272346;

          input {
            margin-right: .35rem;
          }
        }
      }
    }

    .calendar {

      @include media-sm {
        padding: 1rem 2rem 0 2rem;
      }

      &.disabled {
        position: relative;
        &:before {
          content: '';
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          background: rgba(255, 255, 255, .5);
          z-index: 10;
        }
      }

      .vc-container {
        margin-right: auto;
        display: block;

        @include media-sm {
          margin: 0;
        }

        .vc-pane {
          @include media-lg {
            min-width: auto;
          }
        }

        .vc-weekday {
          @include media-lg {
            font-size: .75rem;
            padding-bottom: 5px;
            margin-bottom: 3px;
          }
          @include media-380 {
            font-size: .6rem;
            padding-bottom: 3px;
          }
        }

        .vc-weeks {
          @include media-lg {
            min-width: 210px;
          }
          @include media-md {
            min-width: 250px;
          }
          @include media-xs {
            min-width: auto;
          }
        }

        .vc-day {
          @include media-lg {
            min-height: auto;
          }
        }

        .vc-weekday {
          font-weight: normal;
          background: #E9E9ED;
        }

        .vc-title {
          font-size: 1rem;
          font-weight: 500;
          @include media-lg {
            font-size: .875rem;
          }
        }

        .vc-day-layer {
          .vc-highlight {
            background-color: #F63E41 !important;
          }
        }

        .vc-highlight {
          @include media-380 {
            width: 25px;
            height: 25px;
          }
        }

        .vc-day-content {
          font-size: .875rem;
          font-weight: normal;
          @include media-lg {
            font-size: .75rem;
          }
          @include media-380 {
            font-size: .6rem;
            width: 25px;
            height: 25px;
            line-height: 25px;
          }
        }
      }
    }
  }

  .info {
    .form-field {
      flex-direction: column;
      .error {
        @include media-sm {
          width: auto;
          left: unset;
          right: 20px;
          bottom: 2px;
          font-size: 0.65rem !important;
        }
      }
      .field {
        position: relative;
      }
      & > div {
        width: 100%;
        &.field {
          margin-bottom: 1.5rem;
          @include media-sm {
            margin-bottom: .75rem;
          }
          input {
            @include media-sm {
              min-height: 40px !important;
              font-size: .85rem !important;
            }
          }
        }
        input.input {
          min-height: 50px;
          padding-left: 1.5rem;
          font-size: 1rem;
          border-radius: 10rem;
          box-shadow: none;
        }
        &.contact {
          display: flex;
          align-items: center;
          justify-content: space-between;
          @include media-md {
            flex-direction: column;
          }
          .field {
            margin: 0;
            flex: 0 0 calc(50% - 5px);
            display: flex;
            @include media-md {
              flex: 0 0 100%;
              width: 100%;
            }
            &:first-child {
              @include media-md {
                margin-bottom: 1.5rem;
              }
              @include media-sm {
                margin-bottom: .75rem;
              }
            }
            input {
              @include media-sm {
                min-height: 40px;
                font-size: .85rem;
              }
            }
          }
          span {
            flex: 0 0 40px;
            text-align: center;
          }
        }
      }
    }
  }
}
</style>