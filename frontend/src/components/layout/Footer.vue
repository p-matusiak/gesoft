<template>
  <footer class="bg-white border-t border-gray-200" role="contentinfo" aria-label="Stopka strony">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Description -->
        <div class="md:col-span-2">
          <router-link to="/" class="inline-block mb-4">
            <img src="/logo.png" alt="GESOFT" class="h-10 w-auto" width="200" height="40" />
          </router-link>
          <p class="text-gray-900 font-semibold mb-1">GESOFT Paweł Matusiak</p>
          <p class="text-gray-500 text-sm mb-3">NIP: 9372553467</p>
          <p class="text-gray-600 mb-4 max-w-md">
            {{ $t('footer.description') }}
          </p>
          <div class="flex space-x-4" role="list" aria-label="Social media">
            <a href="https://www.facebook.com/gesoftpoland/" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-brand-600 transition-colors" aria-label="Facebook GESOFT - Otwiera się w nowym oknie">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <nav aria-label="Szybkie linki">
          <h4 class="text-gray-900 font-semibold mb-4">{{ $t('footer.quickLinks') }}</h4>
          <ul class="space-y-2" role="list">
            <li><router-link to="/" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.home') }}</router-link></li>
            <li><router-link to="/o-nas" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.about') }}</router-link></li>
            <li><router-link to="/uslugi" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.services') }}</router-link></li>
            <li><router-link to="/portfolio" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.portfolio') }}</router-link></li>
            <li><router-link to="/artykuly" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.articles') }}</router-link></li>
            <li><router-link to="/kontakt" class="text-gray-600 hover:text-brand-600 transition-colors">{{ $t('nav.contact') }}</router-link></li>
          </ul>
        </nav>

        <!-- Contact -->
        <address class="not-italic">
          <h4 class="text-gray-900 font-semibold mb-4">{{ $t('footer.contact') }}</h4>
          <ul class="space-y-3 text-gray-600" role="list">
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-brand-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <a href="mailto:biuro@gesoft.pl" class="hover:text-brand-600 transition-colors" aria-label="Wyślij email: biuro@gesoft.pl">biuro@gesoft.pl</a>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-brand-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              <a href="tel:+48517123374" class="hover:text-brand-600 transition-colors" aria-label="Zadzwoń: +48 517 123 374">+48 517 123 374</a>
            </li>
            <li class="flex items-start space-x-3">
              <svg class="w-5 h-5 text-brand-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span>{{ $t('contact.info.locationValue') }}</span>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-brand-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <span class="text-brand-600 font-medium">{{ $t('contact.info.invoiceValue') }}</span>
            </li>
          </ul>
        </address>
      </div>

      <!-- Trust Badges -->
      <div class="border-t border-gray-200 mt-8 pt-8">
        <div class="flex flex-wrap items-center justify-center gap-6 mb-6">
          <div class="flex items-center gap-2 text-gray-600 text-sm">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>SSL/HTTPS</span>
          </div>
          <div class="flex items-center gap-2 text-gray-600 text-sm">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>6 miesiecy gwarancji</span>
          </div>
          <div class="flex items-center gap-2 text-gray-600 text-sm">
            <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>NDA / Poufnosc</span>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t border-gray-200 mt-4 pt-6 text-center text-gray-500">
        <p><small>&copy; {{ currentYear }} GESOFT Pawel Matusiak. {{ $t('footer.copyright') }}</small></p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed } from 'vue'

const currentYear = computed(() => new Date().getFullYear())
</script>
