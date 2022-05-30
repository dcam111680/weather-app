<template>
    <section :class="attr['content']">
        <article :class="attr['content__items']">
            <header>
            <h2 :class="attr['content__title']">Cities</h2>
        </header>
        <div v-for="(record, key) in records" :key="key" :class="attr['content__item']">
            <figure :class="attr['content__item-image']">
                <img :src="`${record.image}`" />
            </figure>
            <div :class="attr['content__item-title']">{{ record.title }}</div>
            <router-link :to="`/${record.slug}`" :class="attr['content__item-link']">
                <div :class="attr['content__link-text']">Explore</div>
            </router-link>
        </div>
        </article>
    </section>
</template>
<script>
export default {
    data: () => ({
        records: [
            {
                title: 'Tokyo',
                slug: 'tokyo',
                image: '/assets/img/tokyo.webp'
            },
            {
                title: 'Yokohama',
                slug: 'yokohama',
                image: '/assets/img/yokohama.webp'
            },
            {
                title: 'Kyoto',
                slug: 'kyoto',
                image: '/assets/img/kyoto.webp'
            },
            {
                title: 'Osaka',
                slug: 'osaka',
                image: '/assets/img/osaka.webp'
            },
            {
                title: 'Sapporo',
                slug: 'sapporo',
                image: '/assets/img/sapporo.webp'
            },
            {
                title: 'Nagoya',
                slug: 'nagoya',
                image: '/assets/img/nagoya.webp'
            }
        ]
    })
};
</script>

<style lang="css" module="attr">
    .content {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 60px 0 20px;
    }

    .content__items {
        display: flex;
        flex-flow: row wrap;
        align-items: flex-start;
        justify-content: space-between;
    }

    .content__items header {
        flex: 0 0 100%;
    }

    .content__title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 30px;
        font-size: 45px;
        text-transform: uppercase;
        text-align: center;
    }

    .content__title::before {
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

    .content__item {
        position: relative;
        flex: 0 0 calc(50% - 20px);
        margin-bottom: 40px;
        border-radius: 5px;
        border: 2px solid #FFB7C5;
    }

    .content__item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.5);
        transition: .4s ease-in-out;
    }

    .content__item-image {
        overflow: hidden;
        border-radius: 5px;
    }

  .content__item-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center;
    border-radius: 5px;
    transform: scale(1);
    transition: .4s ease-in-out;
  }

  .content__item-title {
    position: absolute;
    bottom: 30px;
    left: 30px;
    z-index: 3;
    padding: 5px 20px;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #FFF;
    border: 2px solid #FFF;
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(3px);
  }

  .content__item-link {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    margin: 0 auto;
    text-align: center;
    z-index: 4;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background-color: #FFB7C5;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-50%) translateZ(1px) scale(0);
    transition: .4s ease-in-out;
  }

  .content__link-text {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 5;
    font-size: 18px;
    font-weight: 600;
    color: #54161E;
    transform: translateY(-50%);
    transition: .4s ease-in-out;
  }

  .content__item:hover .content__item-image img {
    transform: scale(1.05);
  }

  .content__item:hover .content__item-link {
    opacity: 1;
    visibility: visible;
    transform: translateY(-50%) translateZ(1px) scale(1);
  }

  .content__item-link:hover {
    width: 105px;
    height: 105px;
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
      padding: 60px 40px 20px;
    }

    .content__item {
      flex: 0 0 100%;
    }

    .content__item-image img {
      height: 500px;
    }

    .content__item .content__item-link {
      opacity: 1;
      visibility: visible;
      transform: translateY(-50%) translateZ(1px) scale(1);
    }
  }
</style>