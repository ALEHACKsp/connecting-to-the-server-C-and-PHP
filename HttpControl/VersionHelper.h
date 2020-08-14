
void Copy(const char* text)
{
	OpenClipboard(NULL);
	EmptyClipboard();
	HGLOBAL hText = GlobalAlloc(GMEM_MOVEABLE, strlen(text) + 1);
	char *ptr = (char*)GlobalLock(hText);
	strcpy_s(ptr, strlen(text) + 1, text);
	GlobalUnlock(hText);
	SetClipboardData(CF_TEXT, hText);
	CloseClipboard();
	GlobalFree(hText);
}

