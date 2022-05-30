<script>
  export default {
    props: {
      label: {
        type: String,
        default: null
      },
      link: {
        type: String,
        default: null
      },
      theme: {
        type: String,
        default: 'button--secondary'
      }
    }
  }
</script>

<template>
  <router-link
    :to="link"
    :class="[
      attr['button'],
      attr[theme]
    ]"
  >
    {{ label }}
  </router-link>
</template>

<style lang="css" module="attr">
  .button {
    display: inline-block;
    padding: 7.5px 15px;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 18px;
    border-radius: 5px;
    transition: .4s ease-in-out;
  }

  .button--secondary {
    color: #FFF;
    background-color: #54161E;
    border: 3px solid #54161E;
  }

  .button--secondary:hover {
    color: #54161E;
    background-color: transparent;
  }
</style>
