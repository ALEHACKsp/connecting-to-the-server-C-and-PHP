#pragma once
#include "cHttp.h"
#include <algorithm>
#include <time.h>
#include <vector>
#include <sstream>
#include "KeyGen.h"

struct _SETTING
{
	std::string   szHost = "you host";
	INT Protocol = HTTP_CLEAR;
}SETTING;



std::string toHex(const char *pchData, int count)
{
	std::string s;
	for (int i = 0; i < count; ++i) {
		unsigned char ch = pchData[i];
		unsigned char lo = ch % 16;
		unsigned char hi = ch / 16;
		s.push_back((hi < 10) ? (hi + 0x30) : (hi + 87));
		s.push_back((lo < 10) ? (lo + 0x30) : (lo + 87));
	}
	return s;
}

struct _USERINFO
{
	std::string szKey;
	_USERINFO()
	{
		CHAR PostHWID[MAX_PATH];
		sprintf(PostHWID, "%X", GetHWID());

		szKey = PostHWID;
		szKey = toHex(szKey.c_str(), 11);
	}
}USERINFO;

std::string DataTime()
{
	CHTTPSession* pHttp = new CHTTPSession;
	std::string szAnswer;
	pHttp->Request(HTTP_POST, SETTING.Protocol, SETTING.szHost, szAnswer, "MESSAGE=DAYS&USERKEY=" + USERINFO.szKey, 0);
	delete pHttp;
	szAnswer = " => licens active: " + szAnswer;
	return szAnswer.c_str();
}

BOOL StartKey(std::string szKey)
{

	CHTTPSession* pHttp = new CHTTPSession;
	std::string szAnswer;

	pHttp->Request(HTTP_POST, SETTING.Protocol, SETTING.szHost, szAnswer, "MESSAGE=LOGIN&USERKEY="+ szKey, 0);
	delete pHttp;
	if (szAnswer.compare("USER NOT EXISTS") == 0)
	{
		return FALSE;
	}
	else
		if (szAnswer.compare("LICENSE EXPIRED") == 0)
		{
			return FALSE;
		}
		else
			if (szAnswer.compare("FALSE USER DATA") == 0)
			{
				return FALSE;
			}
			else
			{
				if (szAnswer.compare("LICENSE GOOD") == 0)
				{
					return TRUE;
				}
			}
	return FALSE;
}