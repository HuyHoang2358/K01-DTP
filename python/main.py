import os, json, requests
import datetime, time

def isExistFile(file_path):
    if os.path.isfile(file_path):
        return True
    return False

def getDataFromJsonFile(file_path):
    with open(file_path, 'r', encoding='utf-8') as f:
        data = json.load(f)
    print(f"{file_path} have: {len(data)} records")
    return data

def sendRequest(url, bodyRequest):
    response = requests.post(url, data=bodyRequest)
    return response



def main():
    entitis_haNoi = getDataFromJsonFile('data/entities_haNoi_orion.json')
    for index,entity in enumerate(entitis_haNoi):
        bodyRequest = {}
        bodyRequest["city_model_code"] = entity["attrs"]["modelUrl"]["value"]
        print(entity["attrs"]["modelUrl"]["value"])
        if not bodyRequest["city_model_code"]:
            continue
        
        if not isExistFile(f"data/json/{bodyRequest['city_model_code']}.json"):
            continue
        dataRaw = getDataFromJsonFile(f"data/json/{bodyRequest['city_model_code']}.json")
        bodyRequest["name"] = dataRaw["result"]["name"]
        placeDetail = dataRaw["result"]["placeDetails"]
        if len(placeDetail) == 0:
            placeDetail = {}
            placeDetail["description"] =  ""
            placeDetail["address"] = dataRaw["result"]["address"]
        else:
            placeDetail = placeDetail[0]

        #if placeDetail["address"] is not None and placeDetail["address"].find("Đà Nẵng") != -1: 
        #    continue

        bodyRequest["description"] = placeDetail["description"]
        bodyRequest["city_id"] = "ha_noi"
        bodyRequest["object_category_id"] = 1
        bodyRequest["address"] =  placeDetail["address"]
        bodyRequest["latitude"] = entity["attrs"]["location"]["value"]["coordinates"][1]
        bodyRequest["longitude"] = entity["attrs"]["location"]["value"]["coordinates"][0]
        bodyRequest["height"] = entity["attrs"]["height"]["value"]
        bodyRequest["start_date"] = datetime.datetime.now()
        bodyRequest["end_date"] = datetime.datetime.now()
        bodyRequest["is_show_name"] = 0
        bodyRequest["name_height"] = entity["attrs"]["pin_height"]["value"]
        bodyRequest["city_model_name"] = dataRaw["result"]["name"]
        bodyRequest["city_model_texture_model_url"] = f"texture/{bodyRequest['city_model_code']}.glb"
        bodyRequest["city_model_no_texture_model_url"] = f"no_texture/{bodyRequest['city_model_code']}.glb"
        bodyRequest["city_model_scale"] = entity["attrs"]["scale"]["value"]
        bodyRequest["city_model_pitch"] = entity["attrs"]["pitch"]["value"]
        bodyRequest["city_model_roll"] = entity["attrs"]["roll"]["value"]
        bodyRequest["city_model_heading"] = entity["attrs"]["heading"]["value"]
        
        print(bodyRequest)

        response = sendRequest('http://127.0.0.1:8000/api/city-objects/store', bodyRequest)
        if response.status_code != 200:
            print("Error ------------")
            print(response.text)
            print(response.status_code)
            break
        if index % 50 == 0:
            print("Waiting 1s...")
            time.sleep(1)

# import data into CSDL
main()