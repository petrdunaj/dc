try{
	browser = bsh.shared.dixons;
	browser.quit();
		 
}catch(Exception e){
    log.error(e.getMessage());
}