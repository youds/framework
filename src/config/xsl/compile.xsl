<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:envelope_0_11="http://youds.com/youds/1.0/config"
	xmlns:compile_1_0="http://youds.com/youds/config/parts/compile/1.0"
	xmlns:compile_1_1="http://youds.com/youds/config/parts/compile/1.1"
>
	
	<xsl:output method="xml" version="1.0" encoding="utf-8" indent="yes" />
	
	<xsl:include href="_common.xsl" />
	
	<xsl:variable name="compile_1_0" select="'http://youds.com/youds/config/parts/compile/1.0'" />
	<xsl:variable name="compile_1_1" select="'http://youds.com/youds/config/parts/compile/1.1'" />
	
	<!-- pre-1.0 backwards compatibility for 1.0 -->
	<!-- non-"envelope" elements are copied to the 1.0 compile namespace -->
	<xsl:template match="envelope_0_11:*">
		<xsl:element name="{local-name()}" namespace="{$compile_1_0}">
			<xsl:copy-of select="@*" />
			<xsl:apply-templates />
		</xsl:element>
	</xsl:template>
	
	<!-- 1.0 backwards compatibility for 1.1 -->
	<xsl:template match="compile_1_0:*">
		<xsl:element name="{local-name()}" namespace="{$compile_1_1}">
			<xsl:copy-of select="@*" />
			<xsl:apply-templates />
		</xsl:element>
	</xsl:template>
	
</xsl:stylesheet>
