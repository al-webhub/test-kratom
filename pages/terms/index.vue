<script setup>
  const {t} = useI18n({useScope: 'local'})

  const setCrumbs = () => {
    useCrumbs().setCrumbs([
        {
          name: t('crumbs.home'),
          link: '/'
        },{
          name: t('title'),
          link: '/guidebook/terms'
        }
    ])
  }

  onMounted(() => {
    setCrumbs()
  })

</script>

<style src="./terms.scss" lang="scss" scoped />

<template>
  <div class="container narrow">
    <h1 class="main-caption main-caption-align">{{ t('title') }}</h1>
    <div v-html="t('content')" class="rich-text"></div>
  </div>
</template>

<i18n>
  {
    en: {
      title: 'Terms & Conditions',
      content: "<p><strong>Introduction</strong></p> <p>The Buyer claims to be over 21 years old. If any person under this age attempts to purchase the products he or she will be prosecuted in accordance with the law.</p> <p>Buyer clearly understands that chemical, physical and toxicological properties of the products that are available via kratomhelper.com are not completely scientifically tested, that is why these properties cannot be guaranteed.</p> <p>Buyer accepts and absolutely agrees with the reserved right of Seller (kratomhelper. com) to constrain and/or reject and/or cancel a bargain to a person whose age is not defined. The buyer also understands that in case this happens all the money the Buyer has paid for this bargain will be refunded in the shortest period.</p> <p>By clicking the Terms and Conditions checkbox at the time of checkout the Buyer states he is 21 years of age or older and that all the information regarding his or her physical address and identity is true.</p> <p><strong>Intent To Use</strong></p> <p>The Buyer takes into consideration that all the products he or she purchases via kratomhelper.com do not serve for diagnosing or/and treatment of any medical conditions or disease and can’t be used as a substitute for any medicine.</p> <p>The products we sell are a scope of pure botanical matter, and we do not provide any instructions for its usage.</p> <p>Kratomhelper.com does not take any responsibility, implied or otherwise, for any consequences the Buyer may face in the result of the usage of our products.</p> <p><strong>No warranties</strong></p> <p>The website kratomhelper.com is provided “as is,” with all the mistakes that could have been done, and kratomhelper.com expresses no representations or warranties, of any kind related to this website or the materials it contains. No information stored on this website shall be interpreted as advice for you.</p> <p><strong>Limitation of Liability</strong></p> <p>Under no conditions, any representatives of the staff of kratomhelper.com or the legal the person itself shall hold liability for anything related to the Buyer's use of this website unless such liability is directly mentioned in the signed contract.</p> <p><strong>Indemnification</strong></p> <p>If any provisions of this Term are broken by the Buyer, — he or she takes all the responsibility and indemnifies to kratomhelper.com the full amount of expenses caused by this fact.</p> <p><strong>Severability</strong></p> <p>If any provision of these Terms turns to be not corresponded with or contravene to any acting law of the USA, such provisions shall be deleted without affecting the remaining provisions herein.</p> <p><strong>Variation of Terms</strong></p> <p>Kratomhelper.com revises these Terms if necessary and for its management discretion. Hence, the Bayer is expected to review the Terms systematically.</p> <p><strong>Assignment</strong></p> <p>The kratomhelper.com can delegate, assign, and transfer its rights and/or obligations under these Terms without any notification. At the same time, the Buyer is not allowed to delegate, assign, or transfer any of his or her rights and/or obligations that are determined by these Terms.</p> <p><strong>Entire Agreement</strong></p> <p>These Terms establish the entire agreement between kratomhelper.com and the Buyer regarding the usage of this Website and supplant supersede all the preceding agreements and regimentation.</p>"
    },
    ru: {
      title: 'Правила и Условия',
      content: "<p><strong>Введение</strong></p> <p>Покупатель подтверждает тот факт, что ему более 18 лет. Если какое-либо лицо, не достигнувшее этого возраста, совершит покупку продукции, представленной на сайте, оно будет привлечено к ответственности в соответствии с законом.</p> <p>Покупатель в полной мере понимает, что химические, физические и токсикологические свойства продуктов, доступных на kratomhelper.com, не прошли полную научную проверку, поэтому их свойства не могут быть гарантированы.</p> <p>Покупатель принимает и полностью соглашается с тем, что Продавец (kratomhelper.com) оставляет за собой право ограничивать и / или отклонять и / или отменять сделку с лицом, возраст которого не определен. Покупатель также понимает и соглашается, что в таком случае, все деньги, уплаченные Покупателем за эту сделку, будут возвращены ему в кратчайшие сроки с учетом особенностей платежных систем/систем пересылки денежных средств, а также с учетом рабочего графика Продавца.</p> <p>Установив флажок «Правила и Условия» во время оформления заказа, Покупатель подтверждает, что ему 18 лет или больше, и что вся информация, касающаяся его или ее физического адреса и личности, верна.</p> <p><strong>Намерение использования</strong></p> <p>Покупатель осознает, что все продукты, которые он или она покупает через kratomhelper.com, не предназначены для диагностики и / или лечения каких-либо заболеваний и не могут использоваться в качестве замены какого-либо медикамента.</p> <p>Продаваемые нами продукты являются природного происхождения, и мы не даем никаких инструкций по их использованию.</p> <p>Kratomhelper.com не несет никакой ответственности, подразумеваемой или иной, за любые последствия, с которыми Покупатель может столкнуться в результате использования наших продуктов.</p> <p><strong>Отсутствие гарантий</strong></p> <p>Веб-сайт kratomhelper.com предоставляет материалы и функции «как есть» со всеми ошибками, которые могли быть сделаны, и kratomhelper.com не дает никаких заверений или гарантий любого рода, связанных с этим веб-сайтом или содержащимися на нем материалами. Никакая информация, хранящаяся на этом веб-сайте, не может рассматриваться как прямо рекомендуемая вам или любым клиентам.</p> <p><strong>Ограничение ответственности</strong></p> <p>Ни при каких условиях представители kratomhelper.com или юридическое лицо собственник не несут ответственности за все, что связано с использованием этого веб-сайта Покупателем, если такая ответственность прямо не указана в подписанном контракте.</p> <p><strong>Возмещение</strong></p> <p>В случае нарушения Покупателем каких-либо положений настоящего документа - он берет на себя всю ответственность и возмещает kratomhelper.com всю сумму расходов, вызванных этим фактом.</p> <p><strong>Соответствие законодательству страны</strong></p> <p>Если какое-либо положение настоящих Условий оказывается не соответствующим или противоречащим действующему законодательству Казахстана, такие положения должны быть удалены без изменения остальных положений настоящего документа.</p> <p><strong>Изменение условий</strong></p> <p>Kratomhelper.com при необходимости и по своему усмотрению оставляет за собой право пересматривать настоящие “правила и условия”. Следовательно, ожидается, что покупатель будет систематически пересматривать данное соглашение.</p> <p><strong>Передача прав и/или обязательств</strong></p> <p>Kratomhelper.com может делегировать, переуступать и передавать свои права и / или обязанности в соответствии с настоящими Правилами и Условиями без какого-либо уведомления клиентов или третьих лиц.</p> <p>В то же время Покупателю не разрешается делегировать, переуступать или передавать какие-либо свои права и / или обязанности, которые определены настоящими Правилами и Условиями.</p> <p><strong>Полное согласие</strong></p> <p>Настоящие Правила и Условия устанавливают полное соглашение между kratomhelper.com и Покупателем в отношении использования данного Веб-сайта и продукции, что на этом сайте размещена и заменяют собой все предыдущие соглашения и регламенты.</p>"
    }
  }
</i18n>
