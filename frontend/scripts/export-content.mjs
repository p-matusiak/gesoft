import { writeFileSync } from 'fs'
import { dirname, resolve } from 'path'
import { fileURLToPath } from 'url'

const root = resolve(dirname(fileURLToPath(import.meta.url)), '../..')

console.log('Artykuły są w PostgreSQL. Sitemap zapisuje: php artisan articles:sitemap')
console.log('Pominięto eksport JS → JSON w', root)
