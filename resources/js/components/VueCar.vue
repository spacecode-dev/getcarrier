<template>
  <div>
    <div id="stepsTab" class="tabs is-centered">
      <ul>
        <li :class="isActiveTab(1)" @click="changeStep(1)">
          <span class="count">1</span>
          <p>Destinations</p>
        </li>
        <li :class="isActiveTab(2)" @click="changeStep(2)">
          <span class="count">2</span>
          <p>Quick verification</p>
        </li>
        <li :class="isActiveTab(3)" @click="changeStep(3)">
          <span class="count">3</span>
          <p>Final details</p>
        </li>
      </ul>
    </div>
    <div v-if="step === 1" class="content-tab step-1">
      <div class="form-field mb-5 is-flex is-justify-content-center">
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
        <div class="field">
          <div :class="['dropdown', 'is-flex', 'is-align-items-center', 'control', 'is-large', zip.to.loading ? 'is-loading' : null]">
            <point width="24"/>
            <input class="input is-large" id="zipTo" type="text" placeholder="Zip To" v-model="zip.to.value" @input="getOrderForm('to')" @focus="zip.to.focus = true" @blur="zip.to.focus = false" autocomplete="nope"/>
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
        <button :class="['field', 'button', submitLoading ? 'is-loading' : null]" @click="submitForm">Choose Your Car</button>
      </div>
      <p class="mb-6 has-text-centered">Your information is safe with us & will not be shared</p>
    </div>
    <div v-else-if="step === 2" class="content-tab step-2">
      <div class="form-field is-flex is-justify-content-center is-align-items-center">
        <div class="field">
          <input v-model="name.value" :class="['input', 'is-large', name.validation ? 'is-danger' : null]" type="text" placeholder="Name" autocomplete="nope"/>
          <p v-if="name.validation" class="help is-danger">{{ name.validation }}</p>
        </div>

        <div class="contact">
          <div class="field">
            <input v-model="phone.value" :class="['input', 'is-large', phone.validation ? 'is-danger' : null]" v-input-mask data-inputmask="'mask': '(999)-999-9999', 'placeholder': '0'" type="text" placeholder="Phone" autocomplete="nope"/>
            <p v-if="phone.validation" class="help is-danger">{{ phone.validation }}</p>
          </div>
<!--          <span class="is-dark has-text-dark has-text-weight-bold">or</span>-->
          <div class="field">
            <input v-model="email.value" :class="['input', 'is-large', email.validation ? 'is-danger' : null]" type="email" placeholder="Email" autocomplete="nope"/>
            <p v-if="email.validation" class="help is-danger">{{ email.validation }}</p>
          </div>
        </div>

        <button :class="['field', 'button', submitLoading ? 'is-loading' : null]" @click="submitForm">Next Step</button>
      </div>
    </div>
    <div v-else-if="step === 3" class="content-tab step-3">
      <div class="form-field is-flex is-justify-content-center">
        <div class="cars">
          <h4>Choose <b>Car</b></h4>
          <div v-for="(vehicle, index) in vehicles" :key="'vehicle-' + index" class="single-car">
            <div class="field is-horizontal">
              <div class="field-body">
                <div class="field">
                  <div class="dropdown is-flex is-align-items-center control is-large">
                    <input class="input is-large" type="text" placeholder="Year" :value="vehicle.year" @focus="vehicle.year_focus = true" @blur="vehicle.year_focus = false" readonly/>
                    <div :class="['dropdown-menu', 'year', vehicle.year_focus ? 'is-active' : null]" role="menu">
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
                    <div v-if="!vehicle.loading && vehicle.make_options.length" :class="['dropdown-menu', 'make', vehicle.make_focus ? 'is-active' : null]" role="menu">
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
          <p v-if="vehicles_validation" class="help is-danger">{{ vehicles_validation }}</p>
        </div>
        <div class="date">
          <div :class="['calendar', dateDetail !== 'On one particular date' ? 'disabled' : null]">
            <v-date-picker :min-date="today" v-model="date" locale="en-US" is-required/>
          </div>
          <div class="detail">
            <h4>Choose <b>the date</b></h4>
            <p>Only once the driver pick up your vehicle, we will charge partial payment for fees</p>
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
          <div class="submit-div">
            <button :class="['button', 'is-rounded', submitLoading ? 'is-loading' : null]" @click="submitForm">Done! See It!</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import point from './includes/svg/point'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import _ from 'lodash'
import Inputmask from 'inputmask';

export default {
  data() {
    return {
      source: 'car-shipping',
      today: new Date(),
      step: 1,
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
    point
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
        this.clearStep(data.step)
      } else if (data.step === 3) {
        this.zip.from.data = data.from
        this.zip.from.value = `${data.from.city}, ${data.from.state}, ${data.from.zip}`
        this.zip.to.data = data.to
        this.zip.to.value = `${data.to.city}, ${data.to.state}, ${data.to.zip}`
        this.name.value = data.name
        this.email.value = data.email
        this.phone.value = data.phone
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
    isActiveTab(current) {
      let classes = []
      if(this.step === current) {
        classes.push('is-active')
      }
      if(current <= this.step) {
        classes.push('link')
      }
      return classes.length ? classes : null
    },
    changeStep(goTo) {
      if(this.step > goTo) {
        this.step = goTo
        if(goTo === 1) {
          let zipToValue = `${this.zip.to.data.city}, ${this.zip.to.data.state}, ${this.zip.to.data.zip}`
          setTimeout(function() {
            Inputmask.remove(document.getElementById('zipTo'))
            document.getElementById('zipTo').value = zipToValue
          }, 1, this)
        }
      }
    },
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
      } else if (step === 2) {
        this.clearValidation()
        this.name.value = null
        this.email.value = null
        this.phone.value = null
        this.vehicles = [this.newVehicle()]
        this.date = new Date()
        this.dateDetail = 'On one particular date'
      } else if (step === 3) {
        this.clearValidation()
        this.vehicles = [this.newVehicle()]
        this.date = new Date()
        this.dateDetail = 'On one particular date'
      }
    },
    clearAll() {
      this.clearValidation()
      this.clearZips()
      this.zip.to.value = ''
      this.zip.from.value = ''
      this.name.value = null
      this.email.value = null
      this.phone.value = null
      this.vehicles = [this.newVehicle()]
      this.date = new Date()
      this.dateDetail = 'On one particular date'
      this.step = 1
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
        console.log(data)
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
        }
      } else if (this.step === 2) {
        formData = {
          source: this.source,
          step: 2,
          name: this.name.value,
          email: this.email.value,
          phone: this.phone.value,
        }
      } else if (this.step === 3) {
        formData = {
          source: this.source,
          step: 3,
          vehicles: this.vehicles.map(function (vehicle) {
            return {year: vehicle.year, make: vehicle.make.make, model: vehicle.model.model, operable: vehicle.operable, convertible: vehicle.convertible, modified: vehicle.modified}
          }),
          date: this.date,
          dateDetail: this.dateDetail,
        }
      }

      this.SEND_FORM(formData).then(data => {
        if(this.step === 3) {
          this.$fire({
            title: 'Your order has been submitted',
            text: 'Wait for the call soon!',
            type: 'success',
            showCancelButton: true,
            confirmButtonColor: '#F63E41',
            cancelButtonColor: '#ffffff',
            confirmButtonText: 'Bid the cost',
            cancelButtonText: 'Stay here'
          }).then(r => {
            this.clearAll()
            this.submitLoading = false
            if (r.value) {
              document.location.href = `${window.location.origin}/order/${data.order_id}`
            }
          });
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
    }
  },
}
</script>

<style lang="scss" scoped>
@import "../../sass/include/mixin";

::v-deep {

  &.form {
    position: relative;
    z-index: 10;
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
      min-height: 40px;
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

  .button {
    font-size: 1.1rem;
    font-weight: bold;
    border: 0;
    box-shadow: none;
    @include media-lg {
      font-size: 1rem;
    }
    @include media-md {
      font-size: .875rem;
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

  .tabs {
    margin-bottom: 0;

    ul {
      border: 0;

      li {
        height: 4.25rem;
        background: rgba(255, 255, 255, .2);
        border-radius: 10rem;
        font-size: 1.125rem;
        padding: 0 !important;
        display: flex;
        margin-bottom: -1.625rem;
        position: relative;
        transition: background .3s ease;
        opacity: .4;

        &.link {
          cursor: pointer;
          opacity: 1;
        }

        @include media-md {
          height: 3.8125rem;
        }

        @include media-sm {
          background: transparent;
        }

        &:not(:first-child) {
          margin-left: 2.5rem;

          @include media-sm {
            margin-left: 1.5rem;
          }

          &:before {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, .2);
            width: 1.6875rem;
            height: .0625rem;
            left: -2.1875rem;
            top: 1.25rem;

            @include media-sm {
              width: .9rem;
              left: -1.3rem;
            }
          }
        }

        &.is-active {
          cursor: default;

          @include media-sm {
            background: rgba(255, 255, 255, .2);
          }

          .count {
            background: #F63E41;
            color: white;
          }

          p {
            @include media-sm {
              max-width: 100rem;
              visibility: visible;
              padding: .4rem 1.5rem 0 .5rem;
            }
          }
        }

        .count {
          width: 2.625rem;
          height: 2.625rem;
          font-weight: bold;
          background: #221e3a;
          color: #83818F;
          display: flex;
          align-items: center;
          justify-content: center;
          border-radius: 10rem;
          @include media-md {
            width: 2.125rem;
            height: 2.125rem;
            font-size: .875rem;
          }
        }

        p {
          color: white !important;
          padding: .5rem 2rem 0 1rem;

          @include media-md {
            padding: .5rem 1.5rem 0 .5rem;
            font-size: .85rem !important;
          }

          @include media-sm {
            max-width: 0;
            overflow: hidden;
            visibility: hidden;
            padding: 0;
            transition: visibility .3s ease;
          }

          @include media-xs {
            display: none;
          }
        }
      }
    }
  }

  .form-field {
    background: white;
    height: 6.25rem;
    border-radius: 6.25rem;
    box-shadow: 0 0.15rem 1rem rgb(0 0 0 / 25%);
    @include media-lg {
      height: 4.6875rem;
    }
    @include media-md {
      height: 3.4rem;
    }

    .field {
      position: relative;

      .help.is-danger {
        position: absolute;
        bottom: -18px;
        font-size: .8rem !important;
        margin: 0;
        line-height: 1;
        left: 0;
        width: 100%;
        text-align: center;
        color: #F63E41 !important;
      }
    }
  }

  .content-tab {
    &.step-1 {
      .form-field {
        margin-right: -.0625rem;
        @include media-md {
          flex-direction: column;
          height: auto;
          background: transparent;
          padding: 0;
          margin: 0;
          border-radius: 0;
          box-shadow: none;
        }
      }

      .field {
        padding: 0 1.875rem;
        display: flex;
        margin: 0;

        @include media-md {
          flex: 0 0 100% !important;
          border: 0 !important;
          padding: .3125rem 1.25rem;
          background: white;
          border-radius: 10rem;
          margin-bottom: .9375rem;
        }

        .dropdown {
          width: 100%;

          .error {
            position: absolute;
            bottom: 1rem;
            color: #F63E41;
            left: 2.6875rem;
            font-size: .875rem;
            @include media-lg {
              bottom: .4375rem;
              font-size: .75rem;
            }
            @include media-md {
              left: 2.4375rem;
              bottom: -.1875rem;
              font-size: .6rem;
            }
          }

          &.is-loading {
            &:after {
              top: calc(50% - 0.625rem);
              transform: translate(0, -50%);
            }
          }
        }

        svg {
          margin-right: .5rem;
        }

        input {
          border: 0;
          color: #272346;
          box-shadow: none;
          font-size: 1.25rem;
          font-weight: bold;

          @include media-lg {
            font-size: 1.125rem;
          }

          @include media-md {
            font-size: 1rem;
          }

          &::placeholder {
            color: #83818F;
            font-size: 1.125rem;
            font-weight: normal;

            @include media-lg {
              font-size: 1rem;
            }
          }
        }

        &:first-child {
          flex: 1 0 38%;
          border-right: .0625rem solid #DEDEE3;
          @include media-md {
            flex: 1 0 36%;
          }
        }

        &:nth-child(2) {
          flex: 1 0 38%;
          @include media-md {
            flex: 1 0 36%;
          }
        }

        &:last-child {
          flex: 1 0 24%;
          border-bottom-right-radius: 6.25rem;
          border-top-right-radius: 6.25rem;
          margin-right: -.0625rem;
          @include media-md {
            flex: 1 0 28%;
          }
        }
      }

      .dropdown-menu {
        top: calc(100% + 5px);
      }

      .button {
        display: flex;
        height: auto;
        background: #F63E41;
        color: white;
        border-radius: 0;

        @include media-md {
          flex: 1 0 100% !important;
          border-radius: 10rem !important;
          margin: 0;
          height: 3.125rem;
          min-height: 3.125rem;
        }
      }
    }

    &.step-2 {
      .form-field {
        padding: 1.125rem 2rem;
        margin-bottom: 6.15rem;

        @include media-md {
          flex-direction: column;
          height: auto;
          background: transparent;
          padding: 0;
          margin: 0 0 1.5rem 0;
          border-radius: 0;
          box-shadow: none;
        }

        .field {
          margin: 0;
          .help.is-danger {
            bottom: -13px;
            font-size: .7rem !important;
            @include media-md {
              width: auto;
              left: unset;
              right: 30px;
              bottom: 2px;
            }
          }
        }

        input {
          border: .0625rem solid #E9E9ED;
          margin: 0 1.1875rem;
          padding: .75rem 1.4375rem;
          border-radius: 3.125rem;
          height: auto;
          max-height: 2.875rem;
          color: #272346;
          box-shadow: none;
          font-size: 1.125rem;

          @include media-lg {
            font-size: 1rem;
            margin: 0 .5rem;
          }

          @include media-md {
            margin: 0;
            border: 0;
            padding-left: 1rem;
            padding-right: 1rem;
          }

          &:active, &:focus, &:hover {
            border: .0625rem solid #b5b5b5;
            @include media-md {
              border: 0;
            }
          }

          &::placeholder {
            color: #83818F;
          }
        }

        .button {
          margin: 0 1.1875rem;
          max-height: 2.875rem;
          border-radius: 3.125rem;
          background: #F63E41;
          color: white;
          border: 0;
          box-shadow: none;
          height: 46px;
        }

        & > .field {
          display: flex;

          &:not(.button) {
            flex: 1 0 28%;
            @include media-md {
              height: 50px;
              flex: 1 0 100% !important;
              border: 0 !important;
              padding: .3125rem 1.25rem;
              background: white;
              border-radius: 10rem;
              margin-bottom: .9375rem;
              width: 100%;
            }
          }
          &.button {
            flex: 1 0 22%;
            @include media-md {
              flex: 1 0 100% !important;
              height: 50px;
              width: 100%;
              min-height: 50px;
            }
          }
        }

        .contact {
          flex: 1 0 50%;
          display: flex;
          align-items: center;
          justify-content: space-between;

          @include media-md {
            flex: 1 0 100%;
            width: 100%;
            flex-direction: column;
            margin-bottom: 0.9375rem;
          }

          .field {
            flex: 0 0 50%;
            display: flex;

            @include media-md {
              flex: 1 0 100%;
              width: 100%;

              &:first-child {
                margin-bottom: .9375rem;
              }

              input {
                margin: 0;
                height: 50px;
                max-height: 50px;
                padding-left: 2rem;
                padding-right: 2rem;
              }
            }
          }
          span {
            flex: 0 0 20px;
            text-align: center;
            @include media-md {
              color: white !important;
            }
          }
        }
      }
    }

    &.step-3 {
      height: 6.25rem;
      position: relative;
      margin-bottom: 6.15rem;

      .form-field {
        height: auto;
        border-radius: .625rem;
        position: absolute;
        width: 100%;

        @include media-md {
          flex-direction: column;
        }
      }

      .cars, .date {
        padding: 1.25rem 1.875rem;
        @include media-md {
          padding: 1rem 1.5rem !important;
        }
        h4 {
          font-size: 1.375rem;
          color: #272346;
          margin-bottom: .5rem;
          @include media-lg {
            font-size: 1.2rem;
          }
        }
        p {
          font-size: .875rem !important;
          margin-bottom: 1rem;
          @include media-sm {
            font-size: .7rem !important;
            margin-bottom: 0;
          }
        }
      }

      .cars {
        flex: 1 0 50%;

        @include media-md {
          border-bottom: 1px solid #DEDEE3;
        }

        .single-car {
          position: relative;
          &:not(.first-child) {
            margin-top: 1rem;
          }
          .removeButton {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translate(0, -50%);
            border: 0;
            background: transparent;
            display: flex;
            padding: 0;
            cursor: pointer;
            outline: none;
            @include media-md {
              right: -17px;
            }
            svg {
              width: 13px;
              fill: #F63E41;
            }
          }
        }

        .checkboxes {
          .field-body {
            @include media-sm {
              display: flex;
              flex-wrap: wrap;
            }
          }
          .field {
            text-align: left;
            margin: 0 1rem;
            flex: 0 0 calc(100% / 3 - 2rem);
            cursor: pointer;
            @include media-sm {
              margin-left: 0;
              margin-bottom: .5rem;
              flex: 0 0 auto;
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
                margin-left: .25rem;
                color: #272346;
                font-weight: 600;
                font-size: .875rem;
              }
              .help {
                margin-top: -4px;
                margin-left: 1.35rem;
                line-height: 1.2;
                font-size: .7rem;
                @include media-xs {
                  font-size: .65rem;
                }
              }
            }
          }
        }

        .field {
          input.input {
            min-height: 40px;
            padding-left: 1.5rem;
            font-size: .875rem;
            border-radius: 10rem;
            box-shadow: none;
            @include media-sm {
              min-height: 40px;
              font-size: .875rem;
            }
          }
        }
      }

      .date {
        padding: 1.25rem 1.875rem;
        display: flex;
        flex: 1 0 50%;
        flex-wrap: wrap;
        border-left: .0625rem solid #DEDEE3;

        @include media-md {
          border-left: 0;
        }

        @include media-xs {
          flex-direction: column;
        }

        .submit-div {

          flex: 1 0 100%;
          margin-top: -2.5rem;
          margin-left: auto;
          display: flex;
          justify-content: flex-end;

          @include media-lg {
            margin-top: -1.5rem;
          }

          @include media-xs {
            order: 3;
            margin-top: 1rem;
            margin-left: 0;
            justify-content: flex-start;
          }
        }

        .button {
          margin: 0;
          border-radius: 3.125rem;
          background: #F63E41;
          color: white;
          border: 0;
          box-shadow: none;
          height: 40px;
          font-size: 0.875rem;
          min-height: 40px;
          padding: 0 3rem;
          @include media-xs {
            width: 100%;
          }
        }

        .detail, .calendar {
          flex: 1 0 50%;

          @include media-sm {
            flex: 1 0 100%;
          }
        }

        .detail {
          @include media-lg {
            flex: 1 0 38%;
          }
          @include media-sm {
            margin-bottom: .75rem;
          }
          @include media-xs {
            order: 1;
          }
          .control {
            display: flex;
            flex-direction: column;

            @include media-sm {
              flex-direction: row;
              flex-wrap: wrap;
            }

            label {
              margin-left: 0;
              margin-bottom: .3rem;
              font-size: .875rem;
              display: flex;
              align-items: center;
              color: #272346;

              @include media-sm {
                margin-left: 0;
                margin-bottom: 0.3rem;
                margin-right: .75rem;
              }

              input {
                margin-right: .35rem;
              }
            }
          }
        }

        .calendar {

          @include media-md {
            flex: 0 0 auto;
            margin-right: 2rem;
          }

          @include media-xs {
            order: 2;
            margin-right: 0;
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

      .help.is-danger {
        color: #F63E41 !important;
        text-align: center;
      }
    }
  }
}
</style>