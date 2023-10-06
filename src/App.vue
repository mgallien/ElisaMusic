<template>
        <!--
        SPDX-FileCopyrightText: Matthieu Gallien <matthieu_gallien@yahoo.fr>
        SPDX-License-Identifier: AGPL-3.0-or-later
        -->
	<NcAppContent>
		<div id="elisa">
			<h1>Hello world!</h1>
		</div>
	</NcAppContent>
</template>

<script>
import NcAppContent from '@nextcloud/vue/dist/Components/NcAppContent.js'

export default {
	name: 'App',
	components: {
		NcAppContent,
	},
}
</script>

<style scoped lang="scss">
#elisa {
	display: flex;
	justify-content: center;
	margin: 16px;
}
</style>
