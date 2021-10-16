<template>
  <div>
    <div class="card">
      <h4 class="is-size-4">Choose Your Car</h4>
      <div class="field">
        <div class="dropdown is-flex is-align-items-center control is-large">
          <point width="20"/>
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
          <point width="20"/>
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
      <button :class="['is-rounded', 'button', 'is-medium', submitLoading ? 'is-loading' : null]" @click="submitForm">Get my door-to-door quote</button>
      <p>Your information is safe with us & will not be shared</p>
    </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import point from './includes/svg/point'

export default {
  data() {
    return {
      source: 'choose-your-car',
      submitLoading: false,
      zip: {
        from: {
          data: null,
          validation: null,
          value: '',
          focus: false,
          loading: false,
          array: []
        },
        to: {
          data: null,
          validation: null,
          value: '',
          focus: false,
          loading: false,
          array: []
        }
      }
    }
  },
  components: {
    point
  },
  mounted() {
    this.GET_STEP({source: this.source}).then(data => {
      if(data.from) {
        this.zip.from.data = data.from
        this.zip.from.value = `${data.from.city}, ${data.from.state}, ${data.from.zip}`
      }
      if(data.to) {
        this.zip.to.data = data.to
        this.zip.to.value = `${data.to.city}, ${data.to.state}, ${data.to.zip}`
      }
    })
  },
  methods: {
    ...mapActions([
      'SEND_FORM',
      'GET_CITY',
      'GET_STEP'
    ]),
    clearZip(zip) {
      zip.data = {
        id: null,
        city: null,
        state: null,
        zip: null,
      }
    },
    selectCity(type, item) {
      this.zip[type].value = `${item.city}, ${item.state}, ${item.zip}`
      this.zip[type].data = item
    },
    getOrderForm(type) {
      let zip = this.zip[type]
      zip.array = []
      zip.validation = null
      if(zip.value.length > 2) {
        zip.loading = true
        this.GET_CITY(zip.value.split(',')[0]).then(data => {
          zip.array = data;
          zip.loading = false
        })
      } else {
        this.clearZip(zip)
      }
    },
    submitForm() {
      let zip = this.zip
      this.submitLoading = true
      zip.from.validation = null
      zip.to.validation = null

      this.SEND_FORM({
        source: this.source,
        from: zip.from.value === '' || zip.from.data.id ? null : zip.from.data,
        to: zip.to.value === '' || zip.to.data.id ? null : zip.to.data
      }).then(data => {
        document.location.href = `${window.location.origin}/order-form?delivery_from=${data.from}&delivery_to=${data.to}`
      }).catch(error => {
        'from' in error.errors ? zip.from.validation = error.errors.from[0] : null
        'to' in error.errors ? zip.to.validation = error.errors.to[0] : null
      })

      this.submitLoading = false
    },
  },
}
</script>

<style lang="scss" scoped>
@import "../../sass/include/mixin";
::v-deep {

  input.input {
    &:focus, &.is-focused, &:active, &:hover, .is-active {
      border-color: #b5b5b5 !important;
    }
  }

  .card {
    text-align: center;
    padding: 2rem 2rem 1rem 2rem;
    max-width: 21.875rem;
    margin-left: auto;
    overflow: inherit;
    display: block;
    border-radius: .625rem;
    @include media-sm {
      margin-left: 0;
      max-width: 100%;
    }
    @include media-xs {
      padding: 2rem 1rem 1rem 1rem;
    }
    h4 {
      font-weight: bold;
      color: black;
      margin-bottom: 1rem;
    }
    .field {
      .dropdown {
        position: relative;
        width: 100%;

        .error {
          position: absolute;
          bottom: .125rem;
          color: #F63E41;
          right: 20px;
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
        font-size: 1rem;
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
      width: 100%;
      height: 3.125rem;
      color: white;
      font-weight: bold;
      box-shadow: none !important;
      border: 0;
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