<template>
  <div class="pt-16 sm:pt-20">
    <!-- Header -->
    <section class="py-12 sm:py-20 bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-4">
          <span class="text-brand-600">{{ $t('contact.header.title') }}</span>
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
          {{ $t('contact.header.subtitle') }}
        </p>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="py-12 sm:py-20 bg-white border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12">
          <!-- Contact Form -->
          <div class="bg-white border border-gray-200 rounded-lg p-5 sm:p-8 relative overflow-hidden">
            <!-- Trust Badge -->
            <div class="absolute top-4 right-4 flex items-center gap-2 bg-green-50 px-3 py-1 rounded-full border border-green-200">
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
              <span class="text-green-700 text-xs font-medium">100% bezpiecznie</span>
            </div>

            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-4">{{ $t('contact.form.title') }}</h2>
            <p class="text-gray-600 text-sm mb-6">Odpowiadamy na wszystkie wiadomosci w ciagu 24 godzin.</p>

            <form @submit.prevent="submitForm" class="space-y-6">
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ $t('contact.form.email') }} <span class="text-red-600">{{ $t('contact.form.required') }}</span>
                </label>
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  required
                  class="input-field"
                  :placeholder="$t('contact.form.emailPlaceholder')"
                  :class="{ 'border-red-500': errors.email }"
                />
                <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
              </div>

              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ $t('contact.form.phone') }}
                </label>
                <input
                  type="tel"
                  id="phone"
                  v-model="form.phone"
                  class="input-field"
                  :placeholder="$t('contact.form.phonePlaceholder')"
                />
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                  {{ $t('contact.form.message') }} <span class="text-red-600">{{ $t('contact.form.required') }}</span>
                </label>
                <textarea
                  id="message"
                  v-model="form.message"
                  required
                  rows="6"
                  maxlength="5000"
                  class="input-field resize-none"
                  :placeholder="$t('contact.form.messagePlaceholder')"
                  :class="{ 'border-red-500': errors.message }"
                ></textarea>
                <div class="flex justify-between mt-1">
                  <p v-if="errors.message" class="text-sm text-red-400">{{ errors.message }}</p>
                  <p class="text-xs text-gray-500 ml-auto">{{ form.message.length }}/5000</p>
                </div>
              </div>

              <button
                type="submit"
                :disabled="isSubmitting"
                class="btn-primary w-full"
                :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }"
              >
                <span v-if="isSubmitting" class="flex items-center justify-center">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  {{ $t('contact.form.submitting') }}
                </span>
                <span v-else>{{ $t('contact.form.submit') }}</span>
              </button>

              <!-- Success Message -->
              <transition name="fade">
                <div v-if="successMessage" class="p-4 bg-green-50 border border-green-200 rounded-md">
                  <p class="text-green-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ successMessage }}
                  </p>
                </div>
              </transition>

              <!-- Error Message -->
              <transition name="fade">
                <div v-if="errorMessage" class="p-4 bg-red-50 border border-red-200 rounded-md">
                  <p class="text-red-700">{{ errorMessage }}</p>
                </div>
              </transition>
            </form>
          </div>

          <!-- Contact Info -->
          <div class="space-y-6 sm:space-y-8">
            <div>
              <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ $t('contact.info.title') }}</h2>
              <div class="grid grid-cols-2 sm:grid-cols-1 gap-4 sm:gap-6">
                <div class="flex items-start space-x-3 sm:space-x-4">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <div class="min-w-0">
                    <h3 class="text-gray-900 font-semibold text-sm sm:text-base mb-0.5 sm:mb-1">{{ $t('contact.info.email') }}</h3>
                    <a href="mailto:biuro@gesoft.pl" class="text-gray-600 hover:text-brand-600 transition-colors text-xs sm:text-base break-all">
                      biuro@gesoft.pl
                    </a>
                  </div>
                </div>

                <div class="flex items-start space-x-3 sm:space-x-4">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                  </div>
                  <div class="min-w-0">
                    <h3 class="text-gray-900 font-semibold text-sm sm:text-base mb-0.5 sm:mb-1">{{ $t('contact.info.phone') }}</h3>
                    <a href="tel:+48517123374" class="text-gray-600 hover:text-brand-600 transition-colors text-xs sm:text-base">+48 517 123 374</a>
                  </div>
                </div>

                <div class="flex items-start space-x-3 sm:space-x-4">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  <div class="min-w-0">
                    <h3 class="text-gray-900 font-semibold text-sm sm:text-base mb-0.5 sm:mb-1">{{ $t('contact.info.hours') }}</h3>
                    <p class="text-gray-600 text-xs sm:text-base">{{ $t('contact.info.hoursValue') }}</p>
                  </div>
                </div>

                <div class="flex items-start space-x-3 sm:space-x-4">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                  </div>
                  <div class="min-w-0">
                    <h3 class="text-gray-900 font-semibold text-sm sm:text-base mb-0.5 sm:mb-1">{{ $t('contact.info.location') }}</h3>
                    <p class="text-gray-600 text-xs sm:text-base">{{ $t('contact.info.locationValue') }}</p>
                  </div>
                </div>

                <div class="flex items-start space-x-3 sm:space-x-4 col-span-2 sm:col-span-1">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 bg-brand-50 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                  </div>
                  <div class="min-w-0">
                    <h3 class="text-gray-900 font-semibold text-sm sm:text-base mb-0.5 sm:mb-1">{{ $t('contact.info.invoice') }}</h3>
                    <p class="text-brand-600 font-medium text-xs sm:text-base">{{ $t('contact.info.invoiceValue') }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- FAQ -->
            <div class="bg-white border border-gray-200 rounded-lg p-5 sm:p-8">
              <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6">{{ $t('contact.faq.title') }}</h3>
              <div class="space-y-4">
                <div>
                  <button
                    @click="faq1Open = !faq1Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q1') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq1Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq1Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a1') }}</p>
                  </transition>
                </div>
                <div>
                  <button
                    @click="faq2Open = !faq2Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q2') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq2Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq2Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a2') }}</p>
                  </transition>
                </div>
                <div>
                  <button
                    @click="faq3Open = !faq3Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q3') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq3Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq3Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a3') }}</p>
                  </transition>
                </div>
                <div>
                  <button
                    @click="faq4Open = !faq4Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q4') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq4Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq4Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a4') }}</p>
                  </transition>
                </div>
                <div>
                  <button
                    @click="faq5Open = !faq5Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q5') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq5Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq5Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a5') }}</p>
                  </transition>
                </div>
                <div>
                  <button
                    @click="faq6Open = !faq6Open"
                    class="w-full flex items-center justify-between text-left text-gray-900 font-medium py-2"
                  >
                    {{ $t('contact.faq.q6') }}
                    <svg
                      class="w-5 h-5 text-gray-500 transition-transform"
                      :class="{ 'rotate-180': faq6Open }"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </button>
                  <transition name="slide">
                    <p v-if="faq6Open" class="text-gray-600 text-sm pb-4">{{ $t('contact.faq.a6') }}</p>
                  </transition>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Trust Section -->
    <section class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-center">
            <div class="w-12 h-12 mx-auto bg-green-50 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <p class="text-gray-900 font-medium text-sm">SSL/HTTPS</p>
            <p class="text-gray-500 text-xs">Bezpieczne polaczenie</p>
          </div>
          <div class="text-center">
            <div class="w-12 h-12 mx-auto bg-blue-50 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <p class="text-gray-900 font-medium text-sm">Faktura VAT</p>
            <p class="text-gray-500 text-xs">Pelna dokumentacja</p>
          </div>
          <div class="text-center">
            <div class="w-12 h-12 mx-auto bg-brand-50 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <p class="text-gray-900 font-medium text-sm">NDA</p>
            <p class="text-gray-500 text-xs">Poufnosc danych</p>
          </div>
          <div class="text-center">
            <div class="w-12 h-12 mx-auto bg-yellow-50 rounded-lg flex items-center justify-center mb-3">
              <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <p class="text-gray-900 font-medium text-sm">Odpowiedz 24h</p>
            <p class="text-gray-500 text-xs">Szybki kontakt</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useI18n } from 'vue-i18n'
import axios from 'axios'

const { t } = useI18n()

const form = reactive({
  email: '',
  phone: '',
  message: ''
})

const errors = reactive({
  email: '',
  message: ''
})

const isSubmitting = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const faq1Open = ref(false)
const faq2Open = ref(false)
const faq3Open = ref(false)
const faq4Open = ref(false)
const faq5Open = ref(false)
const faq6Open = ref(false)

const validateForm = () => {
  let isValid = true
  errors.email = ''
  errors.message = ''

  if (!form.email) {
    errors.email = t('contact.form.emailRequired')
    isValid = false
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
    errors.email = t('contact.form.emailInvalid')
    isValid = false
  }

  if (!form.message) {
    errors.message = t('contact.form.messageRequired')
    isValid = false
  } else if (form.message.length < 10) {
    errors.message = t('contact.form.messageMin')
    isValid = false
  }

  return isValid
}

const submitForm = async () => {
  successMessage.value = ''
  errorMessage.value = ''

  if (!validateForm()) return

  isSubmitting.value = true

  try {
    const response = await axios.post('/api/contact', {
      email: form.email,
      phone: form.phone || null,
      message: form.message
    })

    successMessage.value = response.data.message || t('contact.form.success')
    form.email = ''
    form.phone = ''
    form.message = ''
  } catch (error) {
    if (error.response?.data?.errors) {
      const apiErrors = error.response.data.errors
      if (apiErrors.email) errors.email = apiErrors.email[0]
      if (apiErrors.message) errors.message = apiErrors.message[0]
    } else {
      errorMessage.value = error.response?.data?.message || t('contact.form.error')
    }
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  max-height: 0;
}
</style>
