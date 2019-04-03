import org.openqa.selenium.By;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.openqa.selenium.TimeoutException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import java.util.*;

driver = bsh.shared.dixons;

wait = new WebDriverWait(driver, 10);
Actions actions = new Actions(driver);
Random random = new Random();e
String xpath = "";

try {
	// Go to http://www.currys.co.uk/
	driver.get("http://www.currys.co.uk/");

	// Hover "Computing" main category
	xpath = "//a[@title='Computing']";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)));
	actions.moveToElement(wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)))).build().perform();

	// Verify whether list of sub-categories is displayed properly
	xpath = "//div[@data-element='Backdrop']";
	wait.until(ExpectedConditions.presenceOfElementLocated(By.xpath(xpath)));
	xpath = "//div[@id='navigation']//li[./a[@title='Computing']]/ul/li";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)));

	// Click on random sub-sub-category from "iPad, Tablets & eReaders" sub-category
	xpath = "//div[@id='navigation']//li[./a[@title='Computing']]/ul/li/div/a[@title='iPad, Tablets & eReaders']";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)));
	actions.moveToElement(wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)))).build().perform();

	xpath = "//div[@id='navigation']//li[./a[@title='Computing']]/ul/li[./div/a[@title='iPad, Tablets & eReaders']]/div[@data-element='Submenu']/ul//a";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath)));
	int listSize = driver.findElements(By.xpath(xpath)).size();
	xpath = "(//div[@id='navigation']//li[./a[@title='Computing']]/ul/li[./div/a[@title='iPad, Tablets & eReaders']]/div[@data-element='Submenu']/ul//a)[" + Integer.toString(random.nextInt(listSize)+1) + "]";
	log.info(xpath);
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();

	// Choose random product from given list
	xpath = "//div[@data-component='product-list-view']/article";
	listSize = driver.findElements(By.xpath(xpath)).size();
	xpath = "//div[@data-component='product-list-view']/article[" + Integer.toString(random.nextInt(listSize)+1) + "]//div[@class='product-images']";
	log.info(xpath);
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();

	// Check whether it's possible to add it into the basket
	xpath = "//div[@id='product-actions']//button[contains(@class, 'add-to-basket')]";
	wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath(xpath))).click();

	xpath = "//div[@id='page']//h1[@class='pageTitle']";
	wait.until(ExpectedConditions.presenceOfElementLocated(By.xpath(xpath))).getText().equals("Added to your basket");

	//create screenshot
	driver.getScreenshotAs(OutputType.FILE).renameTo(new java.io.File("${RESULTS_PATH_SCREENSHOT}"+System.currentTimeMillis()+"_Screenshot.png"));

} catch (Exception e) {
	log.error(e.getMessage());
	SampleResult.setSuccessful(false);
	SampleResult.setResponseMessage(e.getMessage());
}