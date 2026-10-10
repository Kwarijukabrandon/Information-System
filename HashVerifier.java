import java.security.MessageDigest;

public class HashVerifier {
    public static void main(String[] args) throws Exception {
        if (args.length < 1) {
            System.out.println("Usage: java HashVerifier <transcript_details>");
            return;
        }

        String input = args[0];

        MessageDigest md = MessageDigest.getInstance("SHA-256");
        byte[] hashBytes = md.digest(input.getBytes("UTF-8"));

        StringBuilder hex = new StringBuilder();
        for (byte b : hashBytes) {
            hex.append(String.format("%02x", b));
        }

        System.out.println("SHA-256 Hash: " + hex.toString());
    }
}