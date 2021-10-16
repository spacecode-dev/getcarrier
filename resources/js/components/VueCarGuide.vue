<template>
  <div>
    <div v-if="step === 1" :class="['card', 'step-' + step]">
      <h4 class="is-size-4">Calculate <b>shipping cost</b></h4>
      <div class="model">
        <h6 class="is-size-6">Car model</h6>
        <div class="dropdown-groups">
          <div class="field without-icon is-width-50 year">
            <div class="dropdown is-flex is-align-items-center control is-large">
              <input class="input is-large" type="text" placeholder="Year" :value="year.value" @focus="year.focus = true" @blur="year.focus = false" readonly/>
              <div v-if="!year.loading && year.array.length" :class="['dropdown-menu', year.focus ? 'is-active' : null]" role="menu">
                <div class="dropdown-content">
                  <a v-for="item in year.array" :class="['dropdown-item', year.value === item ? 'is-active' : null]" :key="'item-year-' + item" @click="year.value = item">
                    {{ item }}
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="field without-icon is-width-50">
            <div class="dropdown is-flex is-align-items-center control is-large">
              <input class="input is-large" type="text" placeholder="Make" v-model="make.value" @input="getMake" @focus="make.focus = true" @blur="make.focus = false"/>
              <div v-if="make.validation" class="error">{{ make.validation }}</div>
              <div v-if="!make.loading && make.array.length" :class="['dropdown-menu', make.focus ? 'is-active' : null]" role="menu">
                <div class="dropdown-content">
                  <a v-for="item in make.array" :class="['dropdown-item', make.data.make === item.make ? 'is-active' : null]" :key="'item-make-' + item.id" @click="selectMake(item)">
                    {{ item.make }}
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="field without-icon is-width-100 models">
            <div class="dropdown is-flex is-align-items-center control is-large">
              <input class="input is-large" type="text" placeholder="Model" :value="model.data.model" @focus="model.focus = true" @blur="model.focus = false"/>
              <div v-if="model.validation" class="error">{{ model.validation }}</div>
              <div v-if="!model.loading && model.array.length" :class="['dropdown-menu', model.focus ? 'is-active' : null]" role="menu">
                <div class="dropdown-content">
                  <a v-for="item in model.array" :class="['dropdown-item', model.data.model === item.model ? 'is-active' : null]" :key="'item-model-' + item.id" @click="model.data = item">
                    {{ item.model }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="location">
        <h6 class="is-size-6">Location</h6>
        <div class="field">
          <div class="dropdown is-flex is-align-items-center control is-large">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 0C6.12297 0 2.96875 3.15422 2.96875 7.03125C2.96875 8.34117 3.3316 9.61953 4.01832 10.7286L9.59977 19.723C9.70668 19.8953 9.89504 20 10.0976 20C10.0992 20 10.1007 20 10.1023 20C10.3066 19.9984 10.4954 19.8905 10.6003 19.7152L16.0395 10.6336C16.6883 9.54797 17.0312 8.30231 17.0312 7.03125C17.0312 3.15422 13.877 0 10 0ZM15.0338 10.032L10.0887 18.2885L5.01434 10.1112C4.44273 9.18805 4.13281 8.12305 4.13281 7.03125C4.13281 3.80039 6.76914 1.16406 10 1.16406C13.2309 1.16406 15.8633 3.80039 15.8633 7.03125C15.8633 8.09066 15.5738 9.12844 15.0338 10.032Z" fill="#83818F"/>
              <path d="M10 3.51562C8.06148 3.51562 6.48438 5.09273 6.48438 7.03125C6.48438 8.95738 8.03582 10.5469 10 10.5469C11.9884 10.5469 13.5156 8.93621 13.5156 7.03125C13.5156 5.09273 11.9385 3.51562 10 3.51562ZM10 9.38281C8.7009 9.38281 7.64844 8.32684 7.64844 7.03125C7.64844 5.73891 8.70766 4.67969 10 4.67969C11.2923 4.67969 12.3477 5.73891 12.3477 7.03125C12.3477 8.30793 11.3197 9.38281 10 9.38281Z" fill="#83818F"/>
            </svg>
            <input class="input is-large" type="text" placeholder="Zip From" v-model="zip.from.value" @input="getOrderForm('from')" @focus="zip.from.focus = true" @blur="zip.from.focus = false"/>
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
          <div class="dropdown is-flex is-align-items-center control is-large">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 0C6.12297 0 2.96875 3.15422 2.96875 7.03125C2.96875 8.34117 3.3316 9.61953 4.01832 10.7286L9.59977 19.723C9.70668 19.8953 9.89504 20 10.0976 20C10.0992 20 10.1007 20 10.1023 20C10.3066 19.9984 10.4954 19.8905 10.6003 19.7152L16.0395 10.6336C16.6883 9.54797 17.0312 8.30231 17.0312 7.03125C17.0312 3.15422 13.877 0 10 0ZM15.0338 10.032L10.0887 18.2885L5.01434 10.1112C4.44273 9.18805 4.13281 8.12305 4.13281 7.03125C4.13281 3.80039 6.76914 1.16406 10 1.16406C13.2309 1.16406 15.8633 3.80039 15.8633 7.03125C15.8633 8.09066 15.5738 9.12844 15.0338 10.032Z" fill="#83818F"/>
              <path d="M10 3.51562C8.06148 3.51562 6.48438 5.09273 6.48438 7.03125C6.48438 8.95738 8.03582 10.5469 10 10.5469C11.9884 10.5469 13.5156 8.93621 13.5156 7.03125C13.5156 5.09273 11.9385 3.51562 10 3.51562ZM10 9.38281C8.7009 9.38281 7.64844 8.32684 7.64844 7.03125C7.64844 5.73891 8.70766 4.67969 10 4.67969C11.2923 4.67969 12.3477 5.73891 12.3477 7.03125C12.3477 8.30793 11.3197 9.38281 10 9.38281Z" fill="#83818F"/>
            </svg>
            <input class="input is-large" type="text" placeholder="Zip To" v-model="zip.to.value" @input="getOrderForm('to')" @focus="zip.to.focus = true" @blur="zip.to.focus = false"/>
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
      <button :class="['arrowed', 'is-rounded', 'button', 'is-medium', submitLoading ? 'is-loading' : null]" @click="submitForm">Get Started</button>
    </div>
    <div v-else-if="step === 2" :class="['card', 'step-' + step]">
      <h4 class="is-size-4">Calculate <b>shipping cost</b></h4>
      <step2SVG width="160"/>
      <div class="verification">
        <h6 class="is-size-6">Verification</h6>
        <div class="field without-icon is-width-100">
          <input class="input is-large" type="text" placeholder="Your Name" v-model="name"/>
        </div>
        <div class="field without-icon is-width-100 contactType">
          <div class="toggleContact">
            <button @click="changeContactType('email', $event)">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" :class="['mail', contact_type === 'email' ? 'is-active' : null]">
                <path d="M507.49,101.721L352.211,256L507.49,410.279c2.807-5.867,4.51-12.353,4.51-19.279V121C512,114.073,510.297,107.588,507.49,101.721z"/>
                <path d="M467,76H45c-6.927,0-13.412,1.703-19.279,4.51l198.463,197.463c17.548,17.548,46.084,17.548,63.632,0L486.279,80.51C480.412,77.703,473.927,76,467,76z"/>
                <path d="M4.51,101.721C1.703,107.588,0,114.073,0,121v270c0,6.927,1.703,13.413,4.51,19.279L159.789,256L4.51,101.721z"/>
                <path d="M331,277.211l-21.973,21.973c-29.239,29.239-76.816,29.239-106.055,0L181,277.211L25.721,431.49C31.588,434.297,38.073,436,45,436h422c6.927,0,13.412-1.703,19.279-4.51L331,277.211z"/>
              </svg>
            </button>
            <button @click="changeContactType('phone', $event)">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39.658 39.658" :class="['phone', contact_type === 'phone' ? 'is-active' : null]">
                <path d="M30.755,0H8.903c-0.829,0-1.5,0.671-1.5,1.5v36.658c0,0.829,0.671,1.5,1.5,1.5h21.852c0.829,0,1.5-0.671,1.5-1.5V1.5C32.255,0.671,31.583,0,30.755,0z M15.996,1.829h7.667c0.275,0,0.5,0.224,0.5,0.5s-0.225,0.5-0.5,0.5h-7.667c-0.276,0-0.5-0.224-0.5-0.5S15.719,1.829,15.996,1.829z M19.829,37.996c-0.736,0-1.333-0.598-1.333-1.333s0.597-1.334,1.333-1.334c0.736,0,1.333,0.599,1.333,1.333S20.565,37.996,19.829,37.996z M29.255,33.829H10.403V4.162h18.852V33.829z"/>
              </svg>
            </button>
          </div>
          <input v-if="contact_type === 'email'" class="input is-large" type="text" placeholder="Your Email" v-model="email" id="emailType"/>
          <input v-else-if="contact_type === 'phone'" class="input is-large" type="text" placeholder="Your Phone" v-model="phone" v-input-mask data-inputmask="'mask': '(999)-999-9999', 'placeholder': '0'"/>
        </div>
      </div>
      <button :class="['arrowed', 'is-rounded', 'button', 'is-medium', submitLoading ? 'is-loading' : null]" @click="submitForm">See Cost</button>
    </div>
    <div v-else-if="step === 3" :class="['card', 'step-' + step]">
      <h4 class="is-size-4">Calculate <b>shipping cost</b></h4>
      <step3SVG width="160"/>
      <div class="cost">
        <h6 class="is-size-6">Your cost for</h6>
        <div class="cost-div">
          <span>Open trailer</span>
          <span class="input is-large">$649</span>
        </div>
        <div class="cost-div">
          <span>Enclosed trailer</span>
          <span class="input is-large">$649</span>
        </div>
      </div>
      <button :class="['is-rounded', 'button', 'is-medium', submitLoading ? 'is-loading' : null]" @click="submitForm">Get Quote</button>
    </div>
    <div v-else-if="step === 4" :class="['card', 'step-' + step]">
      <h4 class="is-size-4">Calculate <b>shipping cost</b></h4>
      <step4SVG width="160"/>
      <p class="success-text">Our manager will call you to provide your vehicle shipping</p>
      <button :class="['is-rounded', 'button', 'is-medium', submitLoading ? 'is-loading' : null]" @click="submitForm">Send More</button>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import Inputmask from 'inputmask'
import step2SVG from './includes/svg/step2'
import step3SVG from './includes/svg/step3'
import step4SVG from './includes/svg/step4'
import _ from 'lodash'

export default {
  data() {
    return {
      step: 1,
      source: 'car-guide',
      submitLoading: false,
      contact_type: 'email',
      year: {
        value: null,
        focus: false,
        array: _.range(new Date().getFullYear(), 1969)
      },
      make: {
        data: {
          id: null,
          make: null,
        },
        value: null,
        validation: null,
        focus: false,
        loading: false,
        array: []
      },
      model: {
        data: {
          id: null,
          model: null,
        },
        focus: false,
        array: []
      },
      zip: {
        from: {
          data: {
            areacode: null,
            city: null,
            county: null,
            dst: null,
            fips: null,
            id: null,
            lat: null,
            lon: null,
            state: null,
            timezone: null,
            zip: null,
            zip_int: null,
          },
          validation: null,
          value: '',
          focus: false,
          loading: false,
          array: []
        },
        to: {
          data: {
            areacode: null,
            city: null,
            county: null,
            dst: null,
            fips: null,
            id: null,
            lat: null,
            lon: null,
            state: null,
            timezone: null,
            zip: null,
            zip_int: null,
          },
          validation: null,
          value: '',
          focus: false,
          loading: false,
          array: []
        }
      },
      name: null,
      email: null,
      phone: null,
    }
  },
  components: {
    step2SVG,
    step3SVG,
    step4SVG,
  },
  methods: {
    ...mapActions([
      'SEND_FORM',
      'GET_LIMIT_CITY',
      'GET_MAKE',
      'GET_MODEL'
    ]),
    clearZip(zip) {
      zip.data = {
        areacode: null,
        city: null,
        county: null,
        dst: null,
        fips: null,
        id: null,
        lat: null,
        lon: null,
        state: null,
        timezone: null,
        zip: null,
        zip_int: null
      }
    },
    clearMake() {
      this.make.data = {
        id: null,
        make: null
      }
    },
    clearModel() {
      this.model.data = {
        id: null,
        model: null
      }
    },
    selectCity(type, item) {
      this.zip[type].value = `${item.city}, ${item.state}, ${item.zip}`
      this.zip[type].data = item
    },
    selectMake(item) {
      this.make.value = item.make
      this.make.data = item
      this.getModel(item.make)
    },
    getOrderForm(type) {
      let zip = this.zip[type]
      zip.array = []
      zip.validation = null
      if(zip.value.length > 2) {
        zip.loading = true
        this.GET_LIMIT_CITY({name: zip.value.split(',')[0], limit: 5}).then(data => {
          zip.array = data;
          zip.loading = false
        })
      } else {
        this.clearZip(zip)
      }
    },
    getMake() {
      this.make.array = []
      this.make.validation = null
      if(this.make.value.length > 2) {
        this.make.loading = true
        this.clearMake()
        this.model.array = []
        this.clearModel()
        this.GET_MAKE({name: this.make.value}).then(data => {
          this.make.array = data
          this.make.loading = false
        })
      }
    },
    getModel(make) {
      this.model.array = []
      this.clearModel()
      this.GET_MODEL({name: make}).then(data => {
        this.model.array = data
      })
    },
    submitForm() {
      this.changeStep()
      // this.submitLoading = true
      // this.SEND_GUIDE_FORM({
      //   from: this.zip.from.data,
      //   to: this.zip.to.data,
      //   vehicle: {
      //     year: this.year.value,
      //     make: this.make.data.make,
      //     model: this.model.data.model
      //   },
      //   name: this.name,
      //   contact: this.contact_type === 'email' ? this.email : this.phone
      // }).then(data => {
      //
      // }).catch(error => {
      //   if(error.status === 422) {
      //
      //   }
      // })
      // this.submitLoading = false
    },
    changeStep() {
      this.step = this.step === 4 ? 1 : this.step+1
    },
    changeContactType(type, e) {
      e.preventDefault()
      this.contact_type = type

      if(type === 'email') {
        setTimeout(function() {
          Inputmask.remove(document.getElementById('emailType'))
        }, 100)
      }
    }
  },
}
</script>

<style lang="scss" scoped>
@import "../../sass/include/mixin";
::v-deep {
  .model {
    position: relative;
    padding-bottom: 1.5rem;
    &:before {
      content: '';
      bottom: 0;
      left: -2rem;
      right: -2rem;
      height: 1px;
      background: #DEDEE3;
      position: absolute;
      opacity: .5;
    }
  }
  .location {
    padding-top: 1rem;
  }
  .verification, .cost {
    text-align: center;
  }
  .contactType {
    display: flex;
    .toggleContact {
      display: flex;
      width: 60px;
      justify-content: space-between;
      margin-right: 7px;
      align-items: center;
      button {
        background: transparent;
        height: auto;
        margin: 0;
        padding: 0;
        outline: none;
      }
      svg {
        width: 20px;
        cursor: pointer;
        fill: gray;
        opacity: .3;
        transition: opacity .3s ease;
        path {
          user-select: none;
        }
        &:hover {
          opacity: .7;
        }
        &.is-active {
          opacity: 1;
        }
      }
    }
  }
  .cost {
    .cost-div {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: .5rem;
      span {
        font-size: 1.1rem;
        &.input {
          border: 0.0625rem solid #E9E9ED;
          border-radius: 3.125rem;
          color: #272346;
          height: 3.125rem;
          font-weight: bold;
          text-align: center;
          flex: 0 0 100px;
          background: #E9E9ED;
          line-height: 1;
          display: flex;
          justify-content: center;
          box-shadow: none;
        }
      }
    }
  }
  .card {
    padding: 2rem 2rem 1rem 2rem;
    width: 21.875rem;
    margin-left: auto;
    overflow: inherit;
    border-radius: .625rem;
    height: 515px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    //@include media-sm {
    //  margin-left: 0;
    //  max-width: 100%;
    //}
    //@include media-xs {
    //  padding: 2rem 1rem 1rem 1rem;
    //}
    .success-text {
      font-size: 1.2rem !important;
      max-width: inherit;
      text-align: center;
    }
    h4 {
      font-weight: normal;
      color: black;
      text-align: center;
      margin-bottom: 2rem;
    }
    .dropdown-groups {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .field {
      &.without-icon {
        input {
          padding: 0 1.1rem;
        }
      }
      &.is-width-50 {
        flex: 0 0 calc(50% - 5px)
      }
      &.is-width-100 {
        flex: 0 0 100%;
      }
      &.year, &.models {
        .dropdown-content {
          max-height: 209px;
          overflow-x: hidden;
        }
      }
      .dropdown {
        position: relative;
        width: 100%;

        .error {
          position: absolute;
          bottom: .125rem;
          color: #F63E41;
          left: 2.6875rem;
          font-size: .65rem;
        }

        &.is-loading {
          &:after {
            top: calc(50% - 0.625rem);
            transform: translate(0, -50%);
          }
        }

        svg {
          position: absolute;
          left: .9375rem;
          z-index: 10;
        }

        .dropdown-menu {
          display: block;
          opacity: 0;
          visibility: hidden;
          width: 100%;
          transition: opacity .3s ease, visibility .3s ease;
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
      }
      input {
        border: .0625rem solid #E9E9ED;
        border-radius: 3.125rem;
        height: auto;
        max-height: 2.875rem;
        color: #272346;
        box-shadow: none;
        min-height: 3.125rem;
        padding: 0 2.8125rem;
        font-weight: bold;
        font-size: .85rem;
        &::placeholder {
          color: #83818F;
          font-size: .875rem;
          font-weight: normal;
        }
      }
    }
    button {
      background: #F63E41;
      font-size: 1rem;
      height: 3.125rem;
      color: white;
      font-weight: bold;
      width: auto;
      margin: auto auto 0;
      display: block;
      position: relative;
      border: 0 !important;
      box-shadow: none !important;
      &.is-loading {
        &:before {
          display: none;
        }
      }
      &.arrowed {
        padding-right: 3rem;
        &:before {
          position: absolute;
          content: '';
          background-image: url('/landings/images/arrow.png');
          width: 30px;
          background-size: 26px;
          transform: rotate(180deg);
          top: 0;
          right: 11px;
          bottom: 0;
          background-repeat: no-repeat;
          background-position: center;
        }
      }
    }
    p {
      font-size: .875rem !important;
      max-width: 11.875rem;
      margin: 1rem auto 0 auto;
      line-height: 1.2;
    }
  }
}
</style>