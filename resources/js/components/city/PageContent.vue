<script>
  import Places from './section/Places.vue'
  import Forecasts from './section/Forecasts.vue'
  import ButtonTemplate from '../template/ButtonTemplate.vue'
  
  export default {
    props: {
      payload: {
        type: Object,
        default: null
      }
    },
    components: {
      Places,
      Forecasts,
      ButtonTemplate
    },
    methods: {
      getValue (item=null, type) {
        let result = ''

        switch (type) {
          case 'image':
            switch (this.$route.params.city) {
              case 'tokyo':
                result = '/assets/img/tokyo.webp'
                break
              case 'yokohama':
                result = '/assets/img/yokohama.webp'
                break
              case 'kyoto':
                result = '/assets/img/kyoto.webp'
                break
              case 'osaka':
                result = '/assets/img/osaka.webp'
                break
              case 'sapporo':
                result = '/assets/img/sapporo.webp'
                break
              case 'nagoya':
                result = '/assets/img/nagoya.webp'
                break
            }
            break
          case 'title':
            switch (this.$route.params.city) {
              case 'tokyo':
                result = 'Tokyo'
                break
              case 'yokohama':
                result = 'Yokohama'
                break
              case 'kyoto':
                result = 'Kyoto'
                break
              case 'osaka':
                result = 'Osaka'
                break
              case 'sapporo':
                result = 'Sapporo'
                break
              case 'nagoya':
                result = 'Nagoya'
                break
            }
            break
          case 'population':
            result = new Intl.NumberFormat().format(item)
            break
        }

        return result
      }
    }
  }
</script>

<template>
  <div :class="attr['content']">
    <button-template
      :label="'Go Back'"
      :link="'/'"
      :class="attr['content__back']"
    />

    <section :class="attr['content__section']">
      <header>
        <h2 :class="attr['content__section-title']">{{ getValue(null, 'title') }}</h2>
      </header>
      <figure :class="attr['content__section-image']">
        <img :src="getValue(null, 'image')" />
      </figure>

      <ul :class="attr['content__section-list']">
        <li>
          <p :class="attr['content__section-list-label']">Population:</p>
          <p>{{ getValue(payload.forecast.city.population, 'population') }}</p>
        </li>
        <li>
          <p :class="attr['content__section-list-label']">Sunrise:</p>
          <p>{{ moment.unix(payload.forecast.city.sunrise).format('MMM DD, YYYY hh:mm A') }}</p>
        </li>
        <li>
          <p :class="attr['content__section-list-label']">Sunset:</p>
          <p>{{ moment.unix(payload.forecast.city.sunset).format('MMM DD, YYYY hh:mm A') }}</p>
        </li>
      </ul>
    </section>

    <!-- Forecasts -->
    <section
      :class="[
        attr['content__section'],
        attr['content__section--minimal']
      ]"
    >
      <header>
        <h2 :class="attr['content__section-title']">Forecasts</h2>
      </header>
      <forecasts
        :payload="payload.forecast"
      />
    </section>

    <!-- Places -->
    <section :class="attr['content__section']">
      <header>
        <h2 :class="attr['content__section-title']">Featured Places</h2>
      </header>
      <places
        :payload="payload.places"
      />
    </section>
  </div>
</template>

<style lang="css" module="attr">
  .content {
    position: relative;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 60px 0 0;
  }

  .content__back {
    margin-bottom: 30px;
  }

  .content__section {
    margin-bottom: 40px;
  }

  .content__section--minimal {
    margin-bottom: 20px;
  }

  .content__section-title {
    position: relative;
    padding-bottom: 10px;
    margin-bottom: 30px;
    font-size: 45px;
    text-transform: uppercase;
    text-align: center;
  }

  .content__section-title::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 50px;
    height: 2px;
    margin: 0 auto;
    background-color: #54161E;
  }

  .content__section-image img {
    border-radius: 5px;
    border: 2px solid #FFB7C5;
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: bottom;
  }

  .content__section-list {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin-top: 20px;
  }

  .content__section-list li {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    flex: 0 0 auto;
    margin: 0 10px;
  }

  .content__section-list li p {
    font-size: 20px;
    font-weight: 700;
    color: #54161E;
  }

  .content__section-list li .content__section-list-label {
    padding-right: 5px;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.3);
  }

  /**
   * 1280px - 1024px */
  @media (max-width: 1280px) and (min-width: 1024px) {
    .content {
      max-width: 100%;
      padding: 60px 40px 20px;
    }
  }

  /**
   * 1024px - 280px */
  @media (max-width: 1024px) and (min-width: 280px) {
    .content {
      max-width: 100%;
      padding: 60px 40px 0;
    }

    .content__section-list {
      justify-content: center;

    }

    .content__section-list li {
      flex: 0 0 100%;
      text-align: center;
      margin: 0 0 10px;
    }

    .content__section-list li p {
      flex: 0 0 100%;
    }

    .content__section-list li .content__section-list-label {
      margin-bottom: 5px;
    }
  }
</style>
