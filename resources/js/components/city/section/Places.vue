<script>
  export default {
    props: {
      payload: {
        type: Object,
        default: null
      }
    }
  }
</script>

<template>
  <div :class="attr['section']">
    <div
      v-for="(result, key) in payload.features"
      :key="key"
      :class="attr['section__item']"
    >
    
      <div :class="attr['section__item-text']">
        <span>Location</span>
        <p>{{ result.properties.formatted }}</p>
      </div>

      <iframe
        width="100%"
        height="170"
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0"
        :src="`https://maps.google.com/maps?q=${result.properties.lat},${result.properties.lon}&z=14&output=embed`"
      ></iframe>

    </div>
  </div>
</template>

<style lang="css" module="attr">
  .section {
    position: relative;
    display: flex;
    flex-flow: row wrap;
    margin: 0 -20px;
  }

  .section__item {
    display: flex;
    flex-flow: row wrap;
    flex: 0 0 calc(33.33% - 40px);
    margin: 0 20px 40px;
    padding: 20px;
    background-color: #FFF;
    border-radius: 5px;
  }

  .section__item-text {
    flex: 0 0 100%;
    margin-bottom: 15px;
    font-weight: 600;
    font-size: 18px;
    color: #54161E;
  }

  .section__item-text span {
    font-size: 14px;
    text-transform: uppercase;
    color: rgba(0, 0, 0, 0.2);
  }

  .section__item-icons {
    display: flex;
    flex-flow: row wrap;
    margin-top: 15px;
  }

  .section__item-icons p {
    flex: 0 0 100%;
    margin-bottom: 5px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    color: rgba(0, 0, 0, 0.2);
  }

  .section__icon-item {
    align-self: flex-end;
    position: relative;
    width: 60px;
    height: 60px;
    margin-right: 10px;
    border-radius: 50%;
    background-color: #FFB7C5;
    border: 2px solid #54161E;
  }

  .section__icon-item:last-child {
    margin-right: 0;
  }

  .section__icon-item img {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    margin: 0 auto;
    transform: translateY(-50%);
  }

  .section__icon-tooltip {
    position: absolute;
    top: 125%;
    left: 50%;
    padding: 5px;
    width: 100px;
    font-size: 12px;
    background-color: #54161E;
    color: #FFF;
    border-radius: 5px;
    text-align: center;
    opacity: 0;
    visibility: hidden;
    transform: translateX(-50%);
    transition: .4s ease-in-out;
  }

  .section__icon-tooltip::before {
    content: '';
    position: absolute;
    top: -7px;
    left: 50%;
    border-bottom: 7px solid #54161E;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    transform: translateX(-50%);
  }

  .section__icon-item:hover .section__icon-tooltip {
    top: 115%;
    opacity: 1;
    visibility: visible;
  }

  /**
   * 1280px - 1024px */
  @media (max-width: 1280px) and (min-width: 1024px) {
    .section__item {
      flex: 0 0 calc((100% / 2) - 40px);
      margin: 0 20px 40px;
    }
  }

  /**
   * 1024px - 280px */
  @media (max-width: 1024px) and (min-width: 280px) {
    .section {
      margin: 0;
    }

    .section__item {
      flex: 0 0 100%;
      margin: 0 0 40px;
    }
  }
</style>
