<template>
  <div>
    <PageHero
      :title="$t('contact.header.title')"
      :subtitle="$t('contact.header.subtitle')"
    />

    <section class="py-16 sm:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
          <div>
            <h2 class="heading-2 text-gray-900 mb-2">{{ $t('contact.form.title') }}</h2>
            <p class="text-gray-600 text-sm mb-8">{{ $t('contact.form.replyNote') }}</p>

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
                  <p v-if="errors.message" class="text-sm text-red-600">{{ errors.message }}</p>
                  <p class="text-xs text-gray-500 ml-auto">{{ form.message.length }}/5000</p>
                </div>
              </div>

              <button
                type="submit"
                :disabled="isSubmitting"
                class="btn-primary"
                :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }"
              >
                <span v-if="isSubmitting" class="flex items-center">
                  {{ $t('contact.form.submitting') }}
                </span>
                <span v-else>{{ $t('contact.form.submit') }}</span>
              </button>

              <transition name="fade">
                <div v-if="errorMessage" class="p-4 bg-red-50 border border-red-200 rounded-md">
                  <p class="text-red-700">{{ errorMessage }}</p>
                </div>
              </transition>
            </form>
          </div>

          <div class="space-y-10">
            <div>
              <h2 class="heading-2 text-gray-900 mb-6">{{ $t('contact.info.title') }}</h2>
              <dl class="space-y-5">
                <div>
                  <dt class="text-sm text-gray-500 mb-1">{{ $t('contact.info.phone') }}</dt>
                  <dd><a href="tel:+48517123374" class="text-gray-900 hover:text-brand-600">+48 517 123 374</a></dd>
                </div>
                <div>
                  <dt class="text-sm text-gray-500 mb-1">{{ $t('contact.info.email') }}</dt>
                  <dd><a href="mailto:biuro@gesoft.pl" class="text-gray-900 hover:text-brand-600">biuro@gesoft.pl</a></dd>
                </div>
                <div>
                  <dt class="text-sm text-gray-500 mb-1">{{ $t('contact.info.hours') }}</dt>
                  <dd class="text-gray-900">{{ $t('contact.info.hoursValue') }}</dd>
                </div>
                <div>
                  <dt class="text-sm text-gray-500 mb-1">{{ $t('contact.info.location') }}</dt>
                  <dd class="text-gray-900">{{ $t('contact.info.locationValue') }}</dd>
                </div>
                <div>
                  <dt class="text-sm text-gray-500 mb-1">{{ $t('contact.info.invoice') }}</dt>
                  <dd class="text-gray-900">{{ $t('contact.info.invoiceValue') }}</dd>
                </div>
              </dl>
            </div>

            <div>
              <h3 class="heading-3 text-gray-900 mb-5">{{ $t('contact.faq.title') }}</h3>
              <div class="space-y-4 border-t border-gray-100">
                <div v-for="(item, index) in faqs" :key="index" class="border-b border-gray-100 py-4">
                  <button
                    type="button"
                    class="w-full flex items-start justify-between text-left text-gray-900 font-medium gap-4"
                    :aria-expanded="openFaq === index"
                    @click="openFaq = openFaq === index ? null : index"
                  >
                    {{ item.q }}
                    <span class="text-gray-400 text-sm flex-shrink-0">{{ openFaq === index ? '−' : '+' }}</span>
                  </button>
                  <p v-if="openFaq === index" class="text-gray-600 text-sm mt-3 leading-relaxed">{{ item.a }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <transition name="modal-fade">
      <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(15,15,15,0.7);backdrop-filter:blur(4px);">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-8">
          <h2 class="heading-2 text-gray-900 mb-3">{{ $t('contact.success.title') }}</h2>
          <p class="text-gray-600 mb-5 leading-relaxed">{{ $t('contact.success.body') }}</p>
          <div class="mb-6 px-4 py-3 bg-gray-50 border border-gray-200 rounded-md">
            <p class="text-xs text-gray-500 mb-1">{{ $t('contact.success.sentTo') }}</p>
            <p class="text-gray-900 font-medium break-all">{{ submittedEmail }}</p>
          </div>
          <button type="button" class="btn-primary w-full" @click="showSuccessModal = false">
            {{ $t('contact.success.ok') }}
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { useRoute } from 'vue-router'
import axios from 'axios'
import PageHero from '@/components/common/PageHero.vue'

const { t } = useI18n()
const route = useRoute()

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
const errorMessage = ref('')
const showSuccessModal = ref(false)
const submittedEmail = ref('')
const openFaq = ref(null)

const faqs = computed(() => [
  { q: t('contact.faq.q1'), a: t('contact.faq.a1') },
  { q: t('contact.faq.q2'), a: t('contact.faq.a2') },
  { q: t('contact.faq.q3'), a: t('contact.faq.a3') },
  { q: t('contact.faq.q4'), a: t('contact.faq.a4') },
  { q: t('contact.faq.q5'), a: t('contact.faq.a5') },
  { q: t('contact.faq.q6'), a: t('contact.faq.a6') }
])

onMounted(() => {
  const projekt = route.query.projekt
  if (projekt) {
    form.message = `Dzień dobry,\nJestem zainteresowany/a projektem: "${projekt}"\n\n`
  }
})

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
  errorMessage.value = ''

  if (!validateForm()) return

  isSubmitting.value = true

  try {
    await axios.post('/api/contact', {
      email: form.email,
      phone: form.phone || null,
      message: form.message
    })

    submittedEmail.value = form.email
    showSuccessModal.value = true
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

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.25s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>
