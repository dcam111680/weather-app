<script>
  export default {
    props: {
      payload: {
        type: Object,
        default: null
      }
    },
    data: () => ({
      records: []
    }),
    methods: {
      getValue (item, type) {
        let result = ''

        switch (type) {
          case 'temperature':
            let celsius = item - 273.15,
              fahrenheit = (item - 273.15) * 9/5 + 32
            celsius = celsius.toFixed(2)
            fahrenheit = fahrenheit.toFixed(2)

            result = `${celsius}°C & ${fahrenheit}°F`
            break
        }

        return result
      },
      toggleAccordion (key) {
        let target = document.getElementById(`__fc${key}`),
            toggler = document.getElementById(`__fct${key}`)

        if (target.classList.contains(this.attr['section__item-accordion--toggled'])) {
          target.style.height = '0px'
          toggler.classList.remove(this.attr['section__item-toggler--active'])
          target.classList.remove(this.attr['section__item-accordion--toggled'])
        } else {
          target.style.height = `${target.scrollHeight}px`
          toggler.classList.add(this.attr['section__item-toggler--active'])
          target.classList.add(this.attr['section__item-accordion--toggled'])
        }
      }
    },
    mounted () {
      let dates = {}
      this.payload.list.forEach((item, key) => {
        let date = item.dt_txt.split(' ')

        if (!dates[date[0]]) dates[date[0]] = []

        dates[date[0]].push(JSON.parse(
          JSON.stringify(item)
        ))
      })
      this.records = dates
    }
  }
</script>

<template>
  <div :class="attr['section']">
    <div
      v-for="(record, key) in records"
      :key="key"
      :class="attr['section__item']"
    >
      <div :class="attr['section__item-top']">
        <div
          :class="[
            attr['section__item-title'],
            attr['section__item-title--big']
          ]"
        >
          {{ moment(key).format('MMM') }}
        </div>
        <div
          :class="[
            attr['section__item-title'],
            attr['section__item-title--small']
          ]"
        >
          {{ moment(key).format('DD') }}
        </div>
      </div>
      <div :class="attr['section__item-bottom']">
        <div :id="`__fct${key}`" :class="attr['section__item-toggler']" @click="toggleAccordion(key)">
          <p>View Forecast</p>
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
            <circle cx="15" cy="15" r="15" fill="#FFF"/>
            <path d="M0,12,6,6,0,0" transform="translate(21.5 13.5) rotate(90)" fill="none" stroke="#FFB7C5" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
          </svg>
        </div>
        <div :id="`__fc${key}`" :class="attr['section__item-accordion']">
          <div
            v-for="(item, key) in record"
            :key="key"
            :class="attr['section__item-row']"
          >
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Time:</p>
              <p :class="attr['section__item-text']">{{ moment(item.dt_txt).format('hh:mm A') }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Weather:</p>
              <div :class="attr['section__item-icons']">
                <figure :class="attr['section__item-icon']" v-for="(weather, key) in item.weather" :key="key">
                  <img :src="`https://openweathermap.org/img/wn/${weather.icon}@2x.png`" />
                  <figcaption :class="attr['section__icon-tooltip']">
                    {{ weather.description }}
                  </figcaption>
                </figure>
              </div>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Feels Like:</p>
              <p :class="attr['section__item-text']">{{ getValue(item.main.feels_like, 'temperature') }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Ground Level:</p>
              <p :class="attr['section__item-text']">{{ item.main.grnd_level }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Humidity:</p>
              <p :class="attr['section__item-text']">{{ item.main.humidity }}%</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Pressure:</p>
              <p :class="attr['section__item-text']">{{ item.main.pressure }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Sea Level:</p>
              <p :class="attr['section__item-text']">{{ item.main.sea_level }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Temperature:</p>
              <p :class="attr['section__item-text']">{{ getValue(item.main.temp, 'temperature') }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Temperature (MAX):</p>
              <p :class="attr['section__item-text']">{{ getValue(item.main.temp_max, 'temperature') }}</p>
            </div>
            <div :class="attr['section__item-inline']">
              <p :class="attr['section__item-label']">Temperature (MIN):</p>
              <p :class="attr['section__item-text']">{{ getValue(item.main.temp_min, 'temperature') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="css" module="attr">
  .section {
    position: relative;
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    margin: 0 -20px;
  }

  .section__item {
    flex: 0 0 calc((100% / 3) - 40px);
    margin: 0 20px 40px;
  }

  .section__item-top {
    padding: 20px;
    background-color: var(--theme_secondary);
    border-radius: 5px 5px 0 0;
    text-align: center;
  }

  .section__item-title {
    font-weight: 700;
    text-transform: uppercase;
    color: var(--theme_white);
  }

  .section__item-title--big {
    font-size: 35px;
  }

  .section__item-title--small {
    margin-top: 5px;
    font-size: 24px;
  }

  .section__item-bottom {
    padding: 20px;
    background-color: var(--theme_primary);
    border-radius: 0 0 5px 5px;
  }

  .section__item-toggler {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    justify-content: space-between;
  }

  .section__item-toggler p {
    font-weight: 700;
    text-transform: uppercase;
    color: var(--theme_secondary);
  }

  .section__item-toggler svg {
    cursor: pointer;
    transform: rotate(0deg);
    transition: .4s ease-in-out;
  }

  .section__item-accordion {
    height: 0px;
    overflow: hidden;
    margin-top: 0;
    transition: .4s ease-in-out;
  }

  .section__item-toggler--active svg {
    transform: rotate(180deg);
  }

  .section__item-accordion--toggled {
    opacity: 1;
    margin-top: 10px;
  }

  .section__item-row {
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.3);
  }

  .section__item-row:first-child {
    padding-top: 15px;
    margin-top: 15px;
    border-top: 2px solid rgba(255, 255, 255, 0.3);
  }

  .section__item-row:last-child {
    padding-bottom: 0;
    margin-bottom: 0;
    border-bottom: none;
  }

  .section__item-inline {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  .section__item-inline:last-child {
    margin-bottom: 0;
  }

  .section__item-label {
    font-weight: 700;
    font-size: 14px;
    color: var(--theme_white);
    text-transform: uppercase;
  }

  .section__item-text {
    flex: 1 0 5%;
    text-align: right;
    font-size: 14px;
    font-weight: 700;
    color: var(--theme_secondary);
  }

  .section__item-icons {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    justify-content: flex-end;
  }

  .section__item-icon {
    position: relative;
    flex: 0 0 auto;
  }

  .section__item-icon img {
    width: 50px;
    height: auto;
  }

  .section__icon-tooltip {
    position: absolute;
    top: 50%;
    left: -115%;
    padding: 5px;
    width: 100px;
    font-size: 12px;
    background-color: var(--theme_secondary);
    color: var(--theme_white);
    border-radius: 5px;
    text-align: center;
    text-transform: capitalize;
    opacity: 0;
    visibility: hidden;
    transform: translate(-50%, -50%);
    transition: .4s ease-in-out;
  }

  .section__icon-tooltip::before {
    content: '';
    position: absolute;
    top: 50%;
    right: -7px;
    border-left: 7px solid var(--theme_secondary);
    border-top: 7px solid transparent;
    border-bottom: 7px solid transparent;
    transform: translateY(-50%);
  }

  .section__item-icon:hover .section__icon-tooltip {
    left: -100%;
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
