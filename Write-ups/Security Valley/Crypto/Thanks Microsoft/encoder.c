#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#if defined(_CHAR_IS_SIGNED)
typedef char                    int8_t;
#else
#if defined(__STDC__)
typedef signed char             int8_t;
#endif
#endif
typedef short                   int16_t;
typedef int                     int32_t;
#ifdef  _LP64
#define _INT64_TYPE
typedef long                    int64_t;
#else   /* _ILP32 */
#if defined(_LONGLONG_TYPE)
#define _INT64_TYPE
typedef long long               int64_t;
#endif
#endif

typedef unsigned char           uint8_t;
typedef unsigned short          uint16_t;
typedef unsigned int            uint32_t;
#ifdef  _LP64
typedef unsigned long           uint64_t;
#else   /* _ILP32 */
#if defined(_LONGLONG_TYPE)
typedef unsigned long long      uint64_t;
#endif
#endif

u_int32_t encodeChar(unsigned char *s) {

    u_int32_t result = 0;

    unsigned int ln = *s & 0x0F;
    unsigned int hn = *s >> 4 & 0x0F;

    u_int8_t x = 0;
    u_int8_t y = 0;

    if(hn <= 9) {
        x = 11;
    } else {
        x = 26;
    }

    if(ln <= 9) {
        y = 14;
    } else {
        y = 26;
    }

    if(hn > 9) {
        hn -= 9;
    }

    if(ln > 9) {
        ln -= 9;
    }


    result |= 0x0E;
    result = result << 6;

    result |= y;
    result = result << 4;

    result |= ln;
    result = result << 6;

    result |= x;
    result = result << 4;

    result |= hn;

    return result;
}

int main(int argc, char *argv[]) {

    if(argc != 2) {
        printf("please give one text input to encode \n");
        exit(0);
    }

    char *input = malloc(strlen(argv[1]));
    strcpy(input, argv[1]);

    for(int i = 0; i < strlen(input); i ++) {
        int chr = encodeChar(input[i]);
        printf("%x", chr);
    }

    printf("\n");
    free(input);

    return 0;
}
