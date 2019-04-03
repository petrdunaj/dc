import org.openqa.selenium.By;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.openqa.selenium.TimeoutException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import java.util.*;

driver = bsh.shared.dixons;

wait = new WebDriverWait(driver, 5);
String xpath = "";
int pages = 0;

try {
	// Go to https://en.wikipedia.org/
	driver.get("https://en.wikipedia.org/");

	// Open random article on Wikipedia
	xpath = "//a[@href='/wiki/Special:Random']";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();

	// Click the first link in the article until you get to the page about Philosophy
	while (true) {
		pages++;
		xpath = "(//div[@id='mw-content-text']//p/a[@href='/wiki/Philosophy'])[1]";
		if (driver.findElements(By.xpath(xpath)).size() > 0) {
			wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();
			break;
		} else {
			xpath = "(//div[@id='mw-content-text']//p/a[not(contains(@class, 'new'))])[1]";
			wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();
		}
	}

	// Count and print out the number of redirects (transitions)
	log.info("Test visits " + Integer.toString(pages) + " before it found Philosophy link on page");
	SampleResult.setResponseData(Integer.toString(pages));

	//create screenshot
	driver.getScreenshotAs(OutputType.FILE).renameTo(new java.io.File("${RESULTS_PATH_SCREENSHOT}"+System.currentTimeMillis()+"_Screenshot.png"));

} catch (Exception e) {
	log.error(e.getMessage());
	SampleResult.setSuccessful(false);
	SampleResult.setResponseMessage(e.getMessage());
}