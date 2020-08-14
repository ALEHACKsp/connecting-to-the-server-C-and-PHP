#pragma once
#include <string>
#include <windows.h>
using namespace std;

char* replace(char* str, const char* f, const char* t) {
	char* tmpPtr = strstr(str, f);

	if (tmpPtr != 0 && strlen(f) >= strlen(t)) {
		size_t sizeDiff = strlen(f) - strlen(t);

		strncpy(tmpPtr, t, strlen(t));

		if (sizeDiff > 0)
			for (tmpPtr += strlen(t); *tmpPtr != '\0'; tmpPtr++)
				*tmpPtr = *(tmpPtr + sizeDiff);
	}
	else
		return 0;

	return str;
}

DWORD GetHWID()
{
	DWORD SerialNum;
	char directory[1024];
	const char* cs = directory; 
		size_t wn = mbsrtowcs(NULL, &cs, 0, NULL);

	// error if wn == size_t(-1)

	wchar_t* buf = new wchar_t[wn + 1]();  // value-initialize to 0 (see below)

	wn = mbsrtowcs(buf, &cs, wn + 1, NULL);

	// error if wn == size_t(-1)

	assert(cs == NULL); // successful conversion

	// result now in buf, return e.g. as std::wstring

	GetSystemWindowsDirectory(directory, 1024);
	replace(directory, "WINDOWS", "");
	replace(directory, "windows", "");
	replace(directory, "Windows", "");
	GetVolumeInformationA(directory, 0, 0, &SerialNum, 0, 0, 0, 0);
	return SerialNum / 2;
}