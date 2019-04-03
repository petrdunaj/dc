import org.openqa.selenium.chrome;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.UnexpectedAlertBehaviour;
import org.openqa.selenium.Point;
import org.openqa.selenium.Dimension;
import org.apache.jmeter.services.FileServer;

try {
	String[] parameter;
	parameter =  new String[] {"disable-infobars", "--window-size=1664,1040"};

	prefs = new HashMap();
	prefs.put("credentials_enable_service", false);
	prefs.put("password_manager_enabled", false); 

	ChromeOptions options = new ChromeOptions();
	options.setExperimentalOption("prefs", prefs);
	options.addArguments(parameter);
	options.setUnhandledPromptBehaviour(UnexpectedAlertBehaviour.ACCEPT);

	WebDriver driver = new ChromeDriver(options);
	driver.manage().window().setPosition(new Point(0, 0));
	driver.manage().window().maximize();
	driver.manage().timeouts().pageLoadTimeout(180, java.util.concurrent.TimeUnit.SECONDS);

	width = driver.manage().window().getSize().getWidth().toString();
	height = driver.manage().window().getSize().getHeight().toString();
	log.debug(driver.getCapabilities().toString());

	//save WebDriver to global bsh.shared.bitpanda
	bsh.shared.dixons = driver;
	log.info("BROWSER WIDTH x HEIGHT -  " + width + " x " + height);

} catch (Exception e) {
	log.error(e.getMessage());
}