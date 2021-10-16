<template>
  <transition name="fade" mode="out-in">
    <div v-if="show" class="cookie has-background-dark">
      <div class="container">
        <div class="columns is-gapless">
          <div class="column">
            <p>We use cookies to give you the best experience. By using our website you agree to our use of cookies in accordance with our <a :href="dataLink" @click="clickPrivacy">Cookies Privacy</a></p>
            <button @click.prevent="submit" class="button">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import {mapActions} from "vuex";

export default {
  props: ['dataCookie', 'dataLink'],
  data() {
    return {
      cookie: false,
      show: false
    }
  },
  created() {
    this.cookie = this.dataCookie
    if(!this.cookie) {
      this.show = true
    }
  },
  methods: {
    ...mapActions([
      'ACCEPT_COOKIE'
    ]),
    clickPrivacy(e) {
      if(this.dataLink === '#') {
        e.preventDefault()
      }
    },
    submit() {
      this.ACCEPT_COOKIE().then(data => {
        if(data) {
          this.show = false
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../sass/include/mixin";
::v-deep {
  &.cookie {
    &.fade-leave-active {
      transition: transform .5s ease-in-out;
    }
    &.fade-leave-to {
      transform: translateY(100px);
    }
  }
}
</style>