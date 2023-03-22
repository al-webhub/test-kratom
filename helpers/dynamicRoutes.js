/**
 * since we can't use imports here we just fetch
 * all our routes from a custom API endpoint where we can use imports
 */
import fetch from 'node-fetch'

export default async () => {
  const getStaticRoutes = () => {
    const base = [
      '/',
      '/faq',
      '/shop',
      '/shop/other-products',
      '/terms',
      '/search',
      '/privacy',
      '/reviews',
      '/rewards',
      '/about_us',
      '/checkout',
      '/contacts',
      '/guidebook',
      '/pay_delivery',
      '/our-advantages',
    ]

    const routes = [
      ...base.map((item) => {
        return {
          url: item,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      }),
      ...base.map((item) => {
        return {
          url: '/ru' + item,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      })
    ]

    return routes
  }

  const fetchProducts = async () => {
    const response = await fetch(`${process.env.API_SERVER_URL}/products?per_page=5000`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    const {data: products} = await response.json();

    const routes = [
      ...products.map((item) => {
        return {
          url: '/ru/' + item.slug,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      }),
      ...products.map((item) => {
        return {
          url: '/' + item.slug,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      })
    ]
    
    return routes
  }

  const fetchArticles = async (lang) => {
    const response = await fetch(`${process.env.API_SERVER_URL}/articles?per_page=5000&lang=${lang}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    
    const {data: articles} = await response.json();

    const preffix = lang === 'en'? '/guidebook/': '/ru/guidebook/'
    const routes = articles.map((item) => {
      return {
        url: preffix + item.slug,
        lastmod: new Date().toISOString(),
        changefreq: 'daily',
        priority: 0.8,
      }
    })

    return routes
  }

  const fetchCategories = async () => {
    const response = await fetch(`${process.env.API_SERVER_URL}/categories?per_page=5000`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    })

    const {data: categories} = await response.json();

    const routes = [
      ...categories.map((item) => {
        return {
          url: '/ru/shop/' + item.slug,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      }),
      ...categories.map((item) => {
        return {
          url: '/shop/' + item.slug,
          lastmod: new Date().toISOString(),
          changefreq: 'daily',
          priority: 0.8,
        }
      })
    ]
    
    return routes
  }


  return [
    ...(await fetchProducts()),
    ...(await fetchCategories()),
    ...(await fetchArticles('ru')),
    ...(await fetchArticles('en')),
    ...getStaticRoutes()
  ]
}