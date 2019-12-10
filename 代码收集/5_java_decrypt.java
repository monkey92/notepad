
class A {

	public String foo(){
		byte[] iv = org.apache.commons.codec.binary.Base64.decodeBase64("EjRWeJCrze8=");
		DESKeySpec desKey = new DESKeySpec(key.getBytes("UTF-8"));
		IvParameterSpec ivValue = new IvParameterSpec(iv);
		SecretKeyFactory keyFactory = SecretKeyFactory.getInstance("DES");
		SecretKey secretKey = keyFactory.generateSecret(desKey);
		Cipher cipher = Cipher.getInstance("DES/CBC/PKCS5Padding");
		cipher.init(Cipher.DECRYPT_MODE, secretKey, ivValue);
		byte[] base = org.apache.commons.codec.binary.Base64.decodeBase64(s);
		byte[] decrypted = cipher.doFinal(base);
		String str = new String(decrypted);
		return str;
	}

}