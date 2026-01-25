<template>
  <footer class="bg-dark-950 border-t border-dark-800" role="contentinfo" aria-label="Stopka strony">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Description -->
        <div class="md:col-span-2">
          <p class="text-white font-medium mb-1">GESOFT Paweł Matusiak</p>
          <p class="text-dark-400 text-sm mb-3">NIP: 9372553467</p>
          <p class="text-dark-400 mb-4 max-w-md">
            {{ $t('footer.description') }}
          </p>
          <div class="flex space-x-4" role="list" aria-label="Social media">
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="text-dark-400 hover:text-primary-400 transition-colors" aria-label="GitHub - Otwiera się w nowym oknie">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
              </svg>
            </a>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="text-dark-400 hover:text-primary-400 transition-colors" aria-label="LinkedIn - Otwiera się w nowym oknie">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <nav aria-label="Szybkie linki">
          <h4 class="text-white font-semibold mb-4">{{ $t('footer.quickLinks') }}</h4>
          <ul class="space-y-2" role="list">
            <li><router-link to="/" class="text-dark-400 hover:text-white transition-colors">{{ $t('nav.home') }}</router-link></li>
            <li><router-link to="/o-nas" class="text-dark-400 hover:text-white transition-colors">{{ $t('nav.about') }}</router-link></li>
            <li><router-link to="/uslugi" class="text-dark-400 hover:text-white transition-colors">{{ $t('nav.services') }}</router-link></li>
            <li><router-link to="/portfolio" class="text-dark-400 hover:text-white transition-colors">{{ $t('nav.portfolio') }}</router-link></li>
            <li><router-link to="/kontakt" class="text-dark-400 hover:text-white transition-colors">{{ $t('nav.contact') }}</router-link></li>
          </ul>
        </nav>

        <!-- Contact -->
        <address class="not-italic">
          <h4 class="text-white font-semibold mb-4">{{ $t('footer.contact') }}</h4>
          <ul class="space-y-3 text-dark-400" role="list">
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <a href="mailto:biuro@gesoft.pl" class="hover:text-white transition-colors" aria-label="Wyślij email: biuro@gesoft.pl">biuro@gesoft.pl</a>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              <a href="tel:+48517123374" class="hover:text-white transition-colors" aria-label="Zadzwoń: +48 517 123 374">+48 517 123 374</a>
            </li>
            <li class="flex items-start space-x-3">
              <svg class="w-5 h-5 text-primary-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <span>{{ $t('contact.info.locationValue') }}</span>
            </li>
            <li class="flex items-center space-x-3">
              <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <span class="text-primary-400 font-medium">{{ $t('contact.info.invoiceValue') }}</span>
            </li>
          </ul>
        </address>
      </div>

      <!-- Trust Badges -->
      <div class="border-t border-dark-800 mt-8 pt-8">
        <div class="flex flex-wrap items-center justify-center gap-6 mb-6">
          <div class="flex items-center gap-2 text-dark-400 text-sm">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>SSL/HTTPS</span>
          </div>
          <div class="flex items-center gap-2 text-dark-400 text-sm">
            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>6 miesiecy gwarancji</span>
          </div>
          <div class="flex items-center gap-2 text-dark-400 text-sm">
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <span>4.9/5 (47 opinii)</span>
          </div>
          <div class="flex items-center gap-2 text-dark-400 text-sm">
            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>NDA / Poufnosc</span>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="border-t border-dark-800 mt-4 pt-6 text-center text-dark-500">
        <p><small>&copy; {{ currentYear }} GESOFT Pawel Matusiak. {{ $t('footer.copyright') }}</small></p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed } from 'vue'

const currentYear = computed(() => new Date().getFullYear())
</script>
